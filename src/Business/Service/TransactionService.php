<?php

namespace Business\Service;

use AppBundle\Model\TransactionModel;
use DataAccess\Repository\TransactionRepository;
use JMS\DiExtraBundle\Annotation as JMS;

/**
 * Class TransactionService
 * @package Business\Service
 *
 * @JMS\Service("transaction_service")
 */
class TransactionService
{
    /** @var TransactionRepository  */
    protected $repository;

    /**
     * TransactionService constructor.
     * @param TransactionRepository $repository
     * @JMS\InjectParams({
     *     "repository" = @JMS\Inject("transaction_repository"),
     * })
     */
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function changeBalance($customerId, $amount)
    {
        $transactionModel = new TransactionModel();
        $transactionModel->setAmount($amount);
        try {
            $transaction = $this->repository->makeTransaction($customerId, $amount);
            $transactionModel->setId($transaction->getId());
        } catch (\Exception $e) {

        }
        return $transactionModel;
    }
}
