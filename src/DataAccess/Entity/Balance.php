<?php

namespace DataAccess\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Balance
 *
 * @ORM\Table(name="balance", indexes={@ORM\Index(name="fk_balance_customer_idx", columns={"customer_id"})})
 * @ORM\Entity
 */
class Balance
{
    /**
     * @var float
     *
     * @ORM\Column(name="balance", type="float", precision=10, scale=0, nullable=false)
     */
    private $balance = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="bonus", type="float", precision=10, scale=0, nullable=false)
     */
    private $bonus = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DataAccess\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     */
    private $customer;



    /**
     * Set balance
     *
     * @param float $balance
     *
     * @return Balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set bonus
     *
     * @param float $bonus
     *
     * @return Balance
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bonus
     *
     * @return float
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer
     *
     * @param \DataAccess\Entity\Customer $customer
     *
     * @return Balance
     */
    public function setCustomer(\DataAccess\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \DataAccess\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
