<?php

namespace DataAccess\Repository;

use DataAccess\Entity\Transaction;
use Symfony\Bridge\Doctrine\RegistryInterface;
use JMS\DiExtraBundle\Annotation as JMS;

/**
 * Class TransactionRepository
 * @package DataAccess\Repository
 *
 * @JMS\Service("transaction_repository")
 */
class TransactionRepository
{
    /** @var RegistryInterface  */
    protected $registry;
    protected $customerRepository;

    /**
     * TransactionRepository constructor.
     * @param RegistryInterface $registry
     * @param CustomerRepository $customerRepository
     *
     * @JMS\InjectParams({
     *     "registry" = @JMS\Inject("doctrine"),
     *     "customerRepository" = @JMS\Inject("customer_repository")
     * })
     */
    public function __construct(
        RegistryInterface $registry,
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->registry = $registry;
    }

    public function listTransactions() {
        $repository = $this->registry->getRepository('Entity:Transaction');
        return $repository->findAll();
    }

    public function listCustomerTransactions($customerId)
    {
        $repository = $this->registry->getRepository('Entity:Transaction');
        return $repository->findBy(['customer_id' => $customerId]);
    }


    public function makeTransaction($customerId, $amount)
    {
        $customer = $this->customerRepository->getCustomerById($customerId);

        $em = $this->registry->getEntityManager();
        $em->beginTransaction();

        try {
            $balance = $em->getRepository('Entity:Balance')->findOneBy(['customer_id' => $customerId]);

            $newBalance = $balance->getBalance() + $amount;
            if ($newBalance < 0) {
                throw new \Exception('balance can\'t be negative');
            }

            $balance->setBalance($newBalance);
            $em->persist($balance);

            $transaction = new Transaction();
            $transaction->setCustomer($customer);
            $transaction->setAmount($amount);

            $em->persist($transaction);
            $em->flush();
            $em->commit();

            return $transaction;
        }
        catch (\Exception $e) {
            $em->rollback();
            throw $e;
        }
    }

}