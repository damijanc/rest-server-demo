<?php

namespace DataAccess\Repository;

use DataAccess\Entity\Transaction;
use Symfony\Bridge\Doctrine\RegistryInterface;


class TransactionRepository
{
    /** @var RegistryInterface  */
    protected $registry;

    public function __construct(RegistryInterface $registry)
    {
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


    public function createTransaction(Transaction $transaction)
    {
        $manager = $this->registry->getManager('Entity:Transaction');
        $manager->persist($transaction);
        $manager->flush();
        return $transaction;
    }

}