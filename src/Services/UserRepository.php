<?php

namespace App\Services;

use App\Registry;
use App\User;
use DateTime;

class UserRepository
{
    private DB $db;
    public function __construct()
    {
        $this->db = Registry::get("DB");
    }

    public function find(int $id): ?User
    {
        $stmt = $this->db->run("SELECT * FROM user WHERE id=:id", ["id" => $id]);
        $row = $stmt->fetch();

        if (empty($row))
            return null;

        $user = new User($row["name"], $row["username"]);
        $user->setCreatedAt(DateTime::createFromFormat("Y-m-d h:i:s", $row["created_at"]));
        $user->setId($row["id"]);
        $user->setPassword($row["password"]);
        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->db->run("SELECT * FROM user WHERE username=:username", ["username" => $username]);
        $row = $stmt->fetch();

        if (empty($row))
            return null;

        $user = new User($row["name"], $row["username"]);
        $user->setCreatedAt(DateTime::createFromFormat("Y-m-d h:i:s", $row["created_at"]));
        $user->setId($row["id"]);
        $user->setPassword($row["password"]);
        return $user;
    }
}