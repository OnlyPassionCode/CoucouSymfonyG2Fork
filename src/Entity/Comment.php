<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options: [
        'unsigned' => true,
    ])]
    private ?int $id = null;

    #[ORM\Column(length: 2500)]
    private ?string $commentMessage = null;

    #[ORM\Column(
        type: Types::DATETIME_MUTABLE,
        options: [
            "default" => "CURRENT_TIMESTAMP"
        ]
    )]
    private ?\DateTimeInterface $commentDateCreated = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(options: [
        'default' => false,
    ])]
    private bool $commentPublished = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentMessage(): ?string
    {
        return $this->commentMessage;
    }

    public function setCommentMessage(string $commentMessage): static
    {
        $this->commentMessage = $commentMessage;

        return $this;
    }

    public function getCommentDateCreated(): ?\DateTimeInterface
    {
        return $this->commentDateCreated;
    }

    public function setCommentDateCreated(\DateTimeInterface $commentDateCreated): static
    {
        $this->commentDateCreated = $commentDateCreated;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isCommentPublished(): bool
    {
        return $this->commentPublished;
    }

    public function setCommentPublished(bool $commentPublished): static
    {
        $this->commentPublished = $commentPublished;

        return $this;
    }
}
