<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
 * @ORM\Entity
 */
class Customers implements UserInterface
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
     * @ORM\Column(name="first_name", type="text", length=100, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="text", length=100, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="text", length=150, nullable=false)
     */
    private $avatar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="join_date", type="datetime", nullable=false)
     */
    private $joinDate;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="customer", orphanRemoval=true)
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="author")
     */
    private $comments;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    // setters
    public function setFirstname($fn)
    {
        $this->firstName = $fn;
        return $this;

    }
    public function setLastname($fn)
    {
        $this->lastName = $fn;
        return $this;
        
    }
    public function setEmail($fn)
    {
        $this->email = $fn;
        return $this;
    }
    public function setPassword($fn)
    {
        $this->password = $fn;
        return $this;

        
    }
    public function setAvatar($fn)
    {
        $this->avatar = $fn;
        return $this;
        
    }
    public function setJoinDate($fn)
    {
        $this->joinDate = $fn;
        return $this;
        
    }

    // getters

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
<<<<<<< HEAD
    public function getPassword()
=======
    public function getPassword():?string
>>>>>>> 9bfb396 (reprise30042023)
    {
        return $this->password;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function getJoinDate()
    {
        return $this->joinDate;
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
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /* gestion de userinterface*/
<<<<<<< HEAD
    public function getRoles()
=======
    public function getRoles():array
>>>>>>> 9bfb396 (reprise30042023)
    {
        return ['ROLE_USER'];
    }
    /*public function getPassword()
    {
        // leaving blank - I don't need/have a password!
    }*/
<<<<<<< HEAD
    public function getSalt()
    {}
=======
    public function getSalt():?string
    {
        return null;
    }
>>>>>>> 9bfb396 (reprise30042023)
    public function eraseCredentials()
    {
        // leaving blank - I don't need/have a password!
    }
    public function getUserName()
    {
        return $this->email;
    }

<<<<<<< HEAD
=======
    public function getUserIdentifier(): string {
        return $this->email;
    }

>>>>>>> 9bfb396 (reprise30042023)


}
