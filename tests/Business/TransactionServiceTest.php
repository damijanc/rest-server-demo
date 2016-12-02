<?php

namespace Tests\Business;

use Business\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TransactionServiceTest extends KernelTestCase
{
    /** @var  TransactionService */
    protected $service;

    protected function setUp()
    {
        parent::setUp();

        self::bootKernel();

        $container = static::$kernel->getContainer();
        $this->service = $container->get('transaction_service');
    }

    public function testChangeBalance()
    {
        $this->service->changeBalance(1, 30);
    }

}