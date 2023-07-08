<?php

namespace App\Forms;

use Core\Validator;
use Core\View;
use JetBrains\PhpStorm\NoReturn;

class CommentForm extends \Core\Form
{

    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes["body"], 1, 1000)) {
            $this->errors["body"] = "A body of no more than 1,000 characters is required.";
        }
    }

    #[NoReturn] public function throw(): void
    {
        header("Location: /post?id={$this->attributes["id"]}&errors=1");
        die();
    }
}