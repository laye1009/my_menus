<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customers::class, inversedBy="comments")
     */
    private $author;

    /**
     * @ORM\OneToOne(targetEntity=Orders::class, cascade={"persist", "remove"})
     */
    private $c_order;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?Customers
    {
        return $this->author;
    }

    public function setAuthor(?Customers $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCOrder(): ?Orders
    {
        return $this->c_order;
    }

    public function setCOrder(?Orders $c_order): self
    {
        $this->c_order = $c_order;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
