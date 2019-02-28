<?php

declare(strict_types=1);

namespace SlimApiBase\Domain;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Users")
 **/
class User implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var int
     */
    protected $id;

    /**
     * @Orm\Column(type="string", length=13, unique=true)
     *
     * @var string
     */
    protected $uniqid;

    /**
     * @Orm\Column(type="string", length=100, unique=true)
     *
     * @var string|null
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $passwordHash;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    protected $active = true;

    /**
     * @ORM\Column(type="datetime", nullable=true);
     *
     * @var null|DateTime
     */
    protected $lastLogin;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     *
     * @var null|string
     */
    protected $lastIp;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->uniqid = uniqid();
    }

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
    public function getUniqid(): string
    {
        return $this->uniqid;
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
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     *
     * @return User
     */
    public function setPasswordHash(string $passwordHash): User
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return User
     */
    public function setActive(bool $active): User
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getLastLogin(): ?DateTime
    {
        return $this->lastLogin;
    }

    /**
     * @param DateTime|null $lastLogin
     *
     * @return User
     */
    public function setLastLogin(?DateTime $lastLogin): User
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastIp(): ?string
    {
        return $this->lastIp;
    }

    /**
     * @param null|string $lastIp
     *
     * @return User
     */
    public function setLastIp(?string $lastIp): User
    {
        $this->lastIp = $lastIp;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->getPasswordHash());
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getUniqid(),
            'email' => $this->getEmail(),
            'lastLogin' => $this->getLastLogin(),
        ];
    }
}
