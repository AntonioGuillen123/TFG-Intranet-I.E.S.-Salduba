<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $user_from = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $user_to = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?NotificationType $type = null;

    #[ORM\Column]
    private ?int $associated_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUserFrom(): ?Session
    {
        return $this->user_from;
    }

    public function setUserFrom(?Session $user_from): static
    {
        $this->user_from = $user_from;

        return $this;
    }

    public function getUserTo(): ?Session
    {
        return $this->user_to;
    }

    public function setUserTo(?Session $user_to): static
    {
        $this->user_to = $user_to;

        return $this;
    }

    public function getType(): ?NotificationType
    {
        return $this->type;
    }

    public function setType(?NotificationType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAssociatedId(): ?int
    {
        return $this->associated_id;
    }

    public function setAssociatedId(int $associated_id): static
    {
        $this->associated_id = $associated_id;

        return $this;
    }
}
