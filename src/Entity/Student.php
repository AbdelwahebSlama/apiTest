<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("student:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("student:read")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("student:read")
     */
    private $last_name;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("student:read")
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups("student:read")
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("student:read")
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("student:read")
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("student:read")
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
