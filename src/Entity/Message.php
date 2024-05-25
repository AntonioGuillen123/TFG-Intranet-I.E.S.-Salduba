<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $affair = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "CURRENT_TIMESTAMP"])]
    private ?\DateTimeInterface $send_date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $user_from = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $user_to = null;

    /**
     * @var Collection<int, UploadFileMessage>
     */
    #[ORM\ManyToMany(targetEntity: UploadFileMessage::class)]
    private Collection $file;

    #[ORM\Column]
    private ?bool $removed = false;

    #[ORM\Column]
    private ?bool $important = false;

    public function __construct()
    {
        $this->file = new ArrayCollection();
        $this->send_date = new \DateTimeInterface();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffair(): ?string
    {
        return $this->affair;
    }

    public function setAffair(string $affair): static
    {
        $this->affair = $affair;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getSendDate(): ?\DateTimeInterface
    {
        return $this->send_date;
    }

    public function setSendDate(?\DateTimeInterface $send_date): static
    {
        $this->send_date = $send_date;

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

    /**
     * @return Collection<int, UploadFileMessage>
     */
    public function getFile(): Collection
    {
        return $this->file;
    }

    public function addFile(UploadFileMessage $file): static
    {
        if (!$this->file->contains($file)) {
            $this->file->add($file);
        }

        return $this;
    }

    public function removeFile(UploadFileMessage $file): static
    {
        $this->file->removeElement($file);

        return $this;
    }

    public function isRemoved(): ?bool
    {
        return $this->removed;
    }

    public function setRemoved(bool $removed): static
    {
        $this->removed = $removed;

        return $this;
    }

    public function isImportant(): ?bool
    {
        return $this->important;
    }

    public function setImportant(bool $important): static
    {
        $this->important = $important;

        return $this;
    }
}
