<?php

namespace  App\Forms;

use App\Models\Authentication;
use App\Models\Registration;
use Core\Validator;
use Core\View;
use JetBrains\PhpStorm\NoReturn;

class RegistrationForm extends \Core\Form
{

    public function __construct($attributes) {

        $this->attributes = $attributes;

        if (!Validator::email($this->attributes["email"])) {
            $this->errors["email"] = "Please provide a valid email address.";
        }

        if (!Validator::string($this->attributes["password"], 7, 255)) {
            $this->errors["password"] = "Please provide a password of at least 7 characters.";
        }

        if ($this->attributes["password"] !== $this->attributes["confirmPassword"]) {
            $this->errors["password"] = "Passwords do not match.";
        }

        if (Authentication::getUser($this->attributes["email"])) {
            $this->errors["email"] = "Email address is already taken.";
        }

        foreach (Authentication::getUsers() as $user) {
            if ($user["username"] === $this->attributes["username"]) {
                $this->errors["username"] = "Username is already taken";
            }
        }

    }

    #[NoReturn] public function throw(): void
    {
        View::render("Registration/index.php", [
            "errors" => $this->errors()
        ]);

        die();
    }
}