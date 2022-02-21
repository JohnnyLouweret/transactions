<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 * @ORM\Table(
 *     name="countries",
 *     indexes= {
 *          @ORM\Index(
 *              name = "name_index",
 *              columns = {"name"}
 *          ),
 *          @ORM\Index(
 *              name = "iso2_index",
 *              columns = {"iso2"}
 *          ),
 *          @ORM\Index(
 *              name = "iso3_index",
 *              columns = {"iso3"}
 *          )
 *      }
 * )
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=63, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2, nullable=false,
     *     options={"collation"="ascii_bin", "comment":"ISO 3166-2 two letter upper case country code."}
     * ))
     */
    private $iso2;

    /**
     * @ORM\Column(type="string", length=3, nullable=true,
     *     options={"collation"="ascii_bin", "comment":"ISO 3166-3 three letter upper case country code."}
     * ))
     */
    private $iso3;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getIso2(): string
    {
        return $this->iso2;
    }

    /**
     * @param string $iso2
     *
     * @return $this
     */
    public function setIso2(string $iso2): self
    {
        $this->iso2 = $iso2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    /**
     * @param string $iso3
     *
     * @return $this
     */
    public function setIso3(string $iso3): self
    {
        $this->iso3 = $iso3;

        return $this;
    }
}
