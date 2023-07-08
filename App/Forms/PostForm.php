<?php

namespace App\Forms;

use Core\Validator;
use Core\View;
use JetBrains\PhpStorm\NoReturn;

class PostForm extends \Core\Form
{

    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes["title"], 1, 255)) {
            $this->errors["title"] = "A title of no more than 255 characters is required.";
        }
    }

    #[NoReturn] public function throw(): void
    {
        View::render("Post/create.php", [
            "errors" => $this->errors()
        ]);

        die();
    }

}