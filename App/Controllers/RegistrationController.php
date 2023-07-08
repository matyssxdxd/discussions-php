<?php

namespace App\Controllers;

use App\Forms\RegistrationForm;
use App\Models\Authentication;
use Core\View;

class RegistrationController extends \App\Models\Registration
{

    public function indexAction(): void
    {
        View::render("Registration/index.php");
    }

    public function registerUser(): void
    {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        RegistrationForm::validate(["username" => $username ,"email" => $email, "password" => $password, "confirmPassword" => $confirmPassword]);

        $this->storeUser($_POST["username"], $_POST["email"] , $_POST["password"]);
        Authentication::login(Authentication::getUser($_POST["email"]));
        header("location: /");
    }
}