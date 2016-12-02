<?php

namespace Tests\Business;

use Business\Service\CustomerService;
use DataAccess\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomerServiceTest extends KernelTestCase
{
    /** @var  CustomerService */
    protected $service;

    protected function setUp()
    {
        parent::setUp();

        self::bootKernel();

        $container = static::$kernel->getContainer();
        $this->service = $container->get('customer_service');
    }

    public function testAddCustomer()
    {
        $json = '{
            "first_name": "Damijan 2",
            "last_name": "Cavar 2",
            "gender": "male",
            "email": "damijan2@cavar.si",
            "country": "DE"
        }';

        $customer = $this->service->addCustomer($json);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertNotNull($customer->getId());

    }

    public function testCustomerHasBonus()
    {
        $json = '{
            "first_name": "Damijan 3",
            "last_name": "Cavar 3",
            "gender": "male",
            "email": "damijan3@cavar.si",
            "country": "DE"
        }';

        $customer = $this->service->addCustomer($json);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertNotNull($customer->getId());
        $this->assertGreaterThan(0,$customer->getBonus());

    }

}