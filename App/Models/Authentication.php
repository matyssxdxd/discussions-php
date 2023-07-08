<?php

namespace App\Models;

use PDO;

class Authentication extends \Core\Database
{

    public static function attempt($email, $password): bool
    {
        $user = static::getUser($email);

        if ($user) {
            if (password_verify($password, $user["password"])) {
                static::login($user);

                return true;
            }
        }

        return false;
    }

    public static function getUsers()
    {
        return (new self())->query("SELECT * FROM users")->findAll();
    }

    public static function getUser($email)
    {
        return (new self())->query("SELECT * FROM users WHERE email = :email", [
            "email" =>$email
        ])->find();
    }

    public static function login($user): void
    {
        $_SESSION["user"] = $user;

        session_regenerate_id(true);
    }

    public static function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie("PHPSESSID", "", time() - 3600,$params["path"], $params["domain"], $params["secure"], $params["httponly"]);

        header("location: /");
    }
}