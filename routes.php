<?php

$router->staticFile("/styles.css", "/static/css/styles.css");
$router->staticFile("/index.js", "/static/js/index.js");

$router->get("/",  [
    "controller" => "PostController",
    "method" => "postListRoute"
]);

$router->get("/post", [
    "controller" => "PostController",
    "method" => "showPostRoute"
]);

$router->post("/like-post", [
    "controller" => "PostController",
    "method" => "likePost"
])->only("auth");

$router->post("/dislike-post", [
    "controller" => "PostController",
    "method" => "dislikePost"
])->only("auth");

$router->get("/register", [
    "controller" => "RegistrationController",
    "method" => "indexAction"
])->only("guest");

$router->post("/register", [
    "controller" => "RegistrationController",
    "method" => "registerUser"
])->only("guest");

$router->get("/login", [
    "controller" => "LoginController",
    "method" => "indexAction"
])->only("guest");

$router->post("/login", [
    "controller" => "LoginController",
    "method" => "loginUser"
])->only("guest");

$router->post("/logout", [
    "controller" => "LoginController",
    "method" => "logoutUser"
])->only("auth");

$router->get("/create-post", [
    "controller" => "PostController",
    "method" => "createPostRoute"
])->only("auth");

$router->post("/create-post", [
    "controller" => "PostController",
    "method" => "addPost"
])->only("auth");

$router->post("/comment", [
    "controller" => "PostController",
    "method" => "addComment"
])->only("auth");