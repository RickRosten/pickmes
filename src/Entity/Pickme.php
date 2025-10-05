<?php

namespace App\Entity;

use App\Repository\PickmeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Entity(repositoryClass: PickmeRepository::class)]
#[Uploadable]

class Pickme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'pickmes')]
    private Collection $User;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[UploadableField(mapping: 'pickme_profile_pic', fileNameProperty: 'profilePicName')]
    private ?File $profilePicFile = null;
    #[ORM\Column(type: types::STRING, nullable: true)]
    private ?string $profilePicName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private $updatedAt = null;

    public function __construct()
    {
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $user): static
    {
        if (!$this->User->contains($user)) {
            $this->User->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->User->removeElement($user);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    public function getProfilePicFile(): ?File
    {
        return $this->profilePicFile;
    }

    public function setProfilePicFile(?File $profilePicFile): Pickme
    {
        $this->profilePicFile = $profilePicFile;
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getProfilePicName(): ?string
    {
        return $this->profilePicName;
    }

    public function setProfilePicName(?string $profilePicName): Pickme
    {
        $this->profilePicName = $profilePicName;
        return $this;
    }

    public function getUpdatedAt(): null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(null $updatedAt): Pickme
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
