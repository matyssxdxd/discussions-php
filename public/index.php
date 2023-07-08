<?php

session_start();
const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "Core/functions.php";

spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', '/', $className);
    $classFile = BASE_PATH . '/' . $classPath . '.php';

    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

$router = new \Core\Router();

$routes = require base_path("routes.php");

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
$method = $_SERVER["REQUEST_METHOD"];

$router->route($uri, $method);