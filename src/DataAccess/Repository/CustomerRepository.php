<?php

namespace DataAccess\Repository;

use DataAccess\Entity\Customer;
use Symfony\Bridge\Doctrine\RegistryInterface;
use JMS\DiExtraBundle\Annotation as JMS;

/**
 * Class CustomerRepository
 * @package DataAccess\Repository
 * @JMS\Service("customer_repository")
 */
class CustomerRepository
{
    /** @var RegistryInterface  */
    protected $registry;

    /**
     * CustomerRepository constructor.
     * @param RegistryInterface $registry
     *
     * @JMS\InjectParams({
     *     "registry" = @JMS\Inject("doctrine"),
     * })
     */
    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function listCustomers() {
        $repository = $this->registry->getRepository('Entity:Customer');
        return $repository->findAll();
    }

    public function getCustomerById($customerId)
    {
        $repository = $this->registry->getRepository('Entity:Customer');
        return $repository->find($customerId);
    }

    public function createCustomer(Customer $customer)
    {
        $manager = $this->registry->getManager();
        $manager->persist($customer);
        $manager->flush();
        return $customer;
    }

}