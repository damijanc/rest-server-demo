<?php

namespace Business\Service;

use AppBundle\Model\CustomerModel;
use DataAccess\Entity\Customer;
use DataAccess\Repository\CustomerRepository;
use JMS\DiExtraBundle\Annotation as JMS;
use JMS\Serializer\SerializerInterface;

/**
 * Class CustomerService
 * @package Business\Service
 *
 * @JMS\Service("customer_service")
 */
class CustomerService
{
    /** @var CustomerRepository  */
    protected $repository;
    /** @var SerializerInterface  */
    protected $serializer;

    /**
     * CustomerController constructor.
     * @param CustomerRepository $repository
     * @param SerializerInterface $serializer
     *
     * @JMS\InjectParams({
     *     "repository" = @JMS\Inject("customer_repository"),
     *     "serializer" = @JMS\Inject("jms_serializer"),
     * })
     */
    public function __construct(CustomerRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function addCustomer($json)
    {
        /** @var CustomerModel $customerModel */
        $customerModel = $this->serializer->deserialize($json, CustomerModel::class, 'json');

        $customer = new Customer();
        $customer->setCountry($customerModel->getCountry());
        $customer->setFirstName($customerModel->getFirstName());
        $customer->setLastName($customerModel->getLastName());
        $customer->setEmail($customerModel->getEmail());
        $customer->setGender($customerModel->getGender());
        $customer->setBonus(rand(5,20) * 0.01);

        return $this->repository->saveCustomer($customer);
    }

    public function updateCustomer($json)
    {
        /** @var CustomerModel $customerModel */
        $customerModel = $this->serializer->deserialize($json, CustomerModel::class, 'json');

        $customer = $this->repository->getCustomerById($customerModel->getId());
        $customer->setCountry($customerModel->getCountry());
        $customer->setFirstName($customerModel->getFirstName());
        $customer->setLastName($customerModel->getLastName());
        $customer->setEmail($customerModel->getEmail());
        $customer->setGender($customerModel->getGender());

        return $this->repository->saveCustomer($customer);
    }
}