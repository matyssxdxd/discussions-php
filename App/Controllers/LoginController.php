<?php

namespace App\Controllers;

use App\Forms\LoginForm;
use App\Models\Authentication;
use Core\View;

class LoginController
{
    public function indexAction(): void
    {
        View::render("Login/index.php");
    }

    public function loginUser(): void
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $form = LoginForm::validate(["email" => $email, "password" => $password]);

        if (!Authentication::attempt($email, $password)) {
            $form->error(
                "email", "No matching account found for that email address and password."
            )->throw();
        }

        header("location: /");
    }

    public function logoutUser(): void
    {
        Authentication::logout();
    }

}