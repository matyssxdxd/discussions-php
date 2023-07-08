<?php

namespace  App\Forms;

use Core\Validator;
use Core\View;
use JetBrains\PhpStorm\NoReturn;

class LoginForm extends \Core\Form
{

    public function __construct($attributes) {

        $this->attributes = $attributes;

        if (!Validator::email($this->attributes["email"])) {
            $this->errors["email"] = "Please provide a valid email address.";
        }

        if (!Validator::string($this->attributes["password"])) {
            $this->errors["password"] = "Please provide a valid password.";
        }
    }

    #[NoReturn] public function throw(): void
    {
        View::render("Login/index.php", [
            "errors" => $this->errors()
        ]);

        die();
    }
}