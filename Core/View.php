<?php

namespace Core;

class View
{
    public static function render($path, $args = []) : void
    {
        extract($args);
        require base_path("App/Views/" . $path);
    }
}