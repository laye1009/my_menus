<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Items
 *
 * @ORM\Table(name="items")
 * @ORM\Entity
 */

 /**
 * @ORM\Entity(repositoryClass="App\Repository\ItemsRepository")
 */
class Items
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
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=false)
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="category", type="integer", nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Orders::class, mappedBy="item")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    // setters
    public function setName($fn)
    {
        $this->name = $fn;
        return $this;

    }
    public function setDescription($fn)
    {
        $this->description = $fn;
        return $this;

    }
    public function setPrice($fn)
    {
        $this->price = $fn;
        return $this;

    }
    public function setImage($fn)
    {
        $this->image = $fn;
        return $this;

    }

    public function setCategory($fn)
    {
        $this->category = $fn;
        return $this;

    }


    // les getters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->addItem($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            $order->removeItem($this);
        }

        return $this;
    }



}
