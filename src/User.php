<?php

namespace App;
use DateTime;

class User
{
    private string $name; // varchar(50)
    private string $username; // varchar(15)
    private DateTime $createdAt; // created_at
    private bool $verified;
    private string $password; // password -> varchar(255)
    private int $id;

    public function __construct(string $name, string $username)
    {
        $this->name = $name;
        $this->username = $username;
        $this->createdAt = new DateTime();
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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return $this->verified;
    }

    /**
     * @param bool $verified
     */
    public function setVerified(bool $verified): void
    {
        $this->verified = $verified;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public  function getId(): int {
        return $this->id;
    }
}