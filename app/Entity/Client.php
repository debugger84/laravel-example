<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @ORM\Table(name="client_view", schema="site")
 */
class Client implements \JsonSerializable
{
    /**
     * @var integer|null
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(length=50)
     */
    private $name = '';

    /**
     * @var string
     * @ORM\Column(length=50)
     */
    private $surname = '';

    /**
    * @var string
    * @ORM\Column(length=50)
    */
    private $code = '';

    /**
     * @var string
     * @ORM\Column(length=255)
     */
    private $email = '';

    /**
     * @var string
     * @ORM\Column(length=255)
     */
    private $address = '';

    /**
     * @var string
     * @ORM\Column(length=100)
     */
    private $city = '';

    /**
     * @var string
     * @ORM\Column(length=100)
     */
    private $country  = '';

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
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
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return $this
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return $this
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
        return $this;
    }

    //Быстрый хак. Лень было для тестового задания делать по-нормлаьному через сериалайзеры.
    public function copyToArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'code' => $this->getCode(),
            'email' => $this->getEmail(),
            'country' => $this->getCountry(),
            'city' => $this->getCity(),
            'address' => $this->getAddress(),
        ];
    }

    public function exchangeArray($data)
    {
        $keys = array_keys($this->copyToArray());
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $this->{$key} = $data[$key];
            }
        }
    }

    public function jsonSerialize() {
        return $this->copyToArray();
    }
}