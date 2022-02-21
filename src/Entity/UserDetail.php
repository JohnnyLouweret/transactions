<?php

namespace App\Entity;

use App\Repository\UserDetailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass=UserDetailRepository::class)
 * @ORM\Table(
 *     name="user_details",
 *     indexes= {
 *          @ORM\Index(
 *              name = "user_index",
 *              columns = {"user_id"}
 *          ),
 *          @ORM\Index(
 *              name = "country_index",
 *              columns = {"citizenship_country_id"}
 *          )
 *      }
 * )
 */
class UserDetail
{
    /**
     * Fields
     */
    const FIELD_API_ID = 'id';
    const FIELD_API_USER_ID = 'user_id';
    const FIELD_API_COUNTRY_ID = 'country_id';
    const FIELD_API_FIRST_NAME = 'first_name';
    const FIELD_API_LAST_NAME = 'last_name';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @MaxDepth(2)
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="details", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $citizenshipCountry;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $phoneNumber;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Country
     */
    public function getCitizenshipCountry(): Country
    {
        return $this->citizenshipCountry;
    }

    /**
     * @param Country $citizenshipCountry
     *
     * @return $this
     */
    public function setCitizenshipCountry(Country $citizenshipCountry): self
    {
        $this->citizenshipCountry = $citizenshipCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::FIELD_API_ID => $this->getId(),
            self::FIELD_API_FIRST_NAME => $this->firstName,
            self::FIELD_API_LAST_NAME => $this->lastName,
            self::FIELD_API_USER_ID => $this->getUser()->getId(),
            self::FIELD_API_COUNTRY_ID => $this->getCitizenshipCountry()->getId()
        ];
    }
}
