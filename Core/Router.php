<?php

namespace Core;

use App\Controllers;
use ReflectionClass;
use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{

    protected array $routes = [];

    protected function add($uri, $params, $request): static
    {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $params["controller"],
            "method" => $params["method"],
            "request" => $request,
            "middleware" => null
        ];

        return $this;
    }

    public function staticFile($uri, $filePath): static
    {
        $this->routes[] = [
            "uri" => $uri,
            "filePath" => $filePath
        ];

        return $this;
    }

    public function get($uri, $params): static
    {
        return $this->add($uri, $params, "GET");
    }

    public function post($uri, $params): static
    {
        return $this->add($uri, $params, "POST");
    }

    public function only($key): static
    {
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;

        return $this;
    }

    public function route($uri, $request): void
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["request"] === strtoupper($request)) {
                if (isset($route["filePath"])) {
                    $this->serverStaticFile($route["filePath"]);
                } else {
                    Middleware::resolve($route["middleware"]);

                    $controllerClassName = "App\\Controllers\\" . $route["controller"];
                    $reflectionClass = new ReflectionClass($controllerClassName);
                    $controller = $reflectionClass->newInstance();
                    $method = $route["method"];
                    $controller->$method();
                    die();
                }
            }
        }

        $this->abort();
    }

        #[NoReturn] protected function abort($code = 404): void
    {
        http_response_code($code);

        View::render("{$code}.php");

        die();
    }

    protected function serverStaticFile($filePath): void
    {
        $file = __DIR__ . "/../public" . $filePath;

        if (file_exists($file)) {
            header("Content-Type: " . mime_content_type($file));
            readfile($file);
            die();
        } else {
            // abort
        }
    }


}

//class Router
//{
//
//    protected array $routes = [];
//
//    public function add($method, $uri, $controller): static
//    {
//        $this->routes[] = [
//            "uri" => $uri,
//            "controller" => $controller,
//            "method" => $method,
//            "middleware" => null
//        ];
//
//        return $this;
//    }
//
//    public function staticFile($uri, $filePath): static
//    {
//        $this->routes[] = [
//            "uri" => $uri,
//            "filePath" => $filePath,
//            "method" => "get",
//            "middleware" => null
//        ];
//
//        return $this;
//    }
//
//    public function get($uri, $controller): static
//    {
//        return $this->add("get", $uri, $controller);
//    }
//
//    public function post($uri, $controller): static
//    {
//        return $this->add("post", $uri, $controller);
//    }
//
//    public function delete($uri, $controller): static
//    {
//        return $this->add("delete", $uri, $controller);
//    }
//
//    public function patch($uri, $controller): static
//    {
//        return $this->add("patch", $uri, $controller);
//    }
//
//    public function put($uri, $controller): static
//    {
//        return $this->add("put", $uri, $controller);
//    }
//
//    public function only($key): static
//    {
//        $this->routes[array_key_last($this->routes)]["middleware"] = $key;
//
//        return $this;
//    }
//
//    #[NoReturn] public function route($uri, $method): void
//    {
//        foreach ($this->routes as $route) {
//            if ($route["uri"] === $uri && $route["method"] === strtolower($method)) {
//                if (isset($route["filePath"])) {
//                    $this->serveStaticFile($route["filePath"]);
//                } else {
//                    // Middleware::resolve($route["middleware"]);
//                    $controllerClassName = "App\\Controllers\\" . $route["controller"];
//                    $reflectionClass = new ReflectionClass($controllerClassName);
//                    $controller = $reflectionClass->newInstance();
//                    $controller->$method();
//                    die();
//                }
//            }
//        }
//
//        $this->abort();
//    }
//
//    public function previousUrl()
//    {
//        return $_SERVER["HTTP_REFERER"];
//    }
//
//    #[NoReturn] protected function abort($code = 404): void
//    {
//        http_response_code($code);
//
//        View::render("{$code}.php");
//
//        die();
//    }
//
//    #[NoReturn] protected function serveStaticFile($filePath): void
//    {
//        $file = __DIR__ . "/../public" . $filePath;
//
//        if (file_exists($file)) {
//            header("Content-Type: " . mime_content_type($file));
//            readfile($file);
//            die();
//        } else {
//            $this->abort(404);
//        }
//    }
//
//
//}