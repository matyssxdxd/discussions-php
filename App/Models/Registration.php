<?php

namespace App\Models;

use PDO;

class Registration extends \Core\Database
{

    public function storeUser($username, $email, $password): void
    {
        $this->query("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)", [
            "username" => $username,
            "email" => $email,
            "password" => $password
        ]);
    }
}