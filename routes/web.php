<?php

$router->get("/", "PageController::index");
$router->get("login", "PageController::login");
$router->get("registration", "PageController::registration");
$router->get("posts", "PageController::posts");

$router->post("api/v1/login", "AuthController::login");
$router->post("api/v1/registration", "AuthController::registration");
$router->post("api/v1/logout", "AuthController::logout");
$router->post("api/v1/isAuthorized", "AuthController::isAuthorized");
$router->post("api/v1/isAdmin", "AuthController::isAdmin");
$router->post("api/v1/addPost", "PostController::addPost");
$router->post("api/v1/getPosts", "PostController::getPosts");
$router->post("api/v1/getAllPosts", "PostController::getAllPosts");
$router->post("api/v1/getPostById", "PostController::getPostById");
$router->post("api/v1/getPostsByTag", "PostController::getPostsByTag");
$router->post("api/v1/getLastPostId", "PostController::getLastPostId");