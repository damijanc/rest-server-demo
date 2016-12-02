<?php

namespace Business\Service;

use AppBundle\Model\TransactionModel;
use DataAccess\Repository\TransactionRepository;

class TransactionService
{
    /** @var TransactionRepository  */
    protected $repository;

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
