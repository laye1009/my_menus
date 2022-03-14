<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerAddresses
 *
 * @ORM\Table(name="customer_addresses")
 * @ORM\Entity
 */
class CustomerAddresses
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="customer", type="integer", nullable=false)
     */
    private $customer;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", length=200, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="text", length=200, nullable=false)
     */
    private $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="text", length=100, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="text", length=100, nullable=false)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="text", length=100, nullable=false)
     */
    private $zipcode;


}
