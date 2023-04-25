<?php

$router->get("/", "PageController::index");
$router->get("login", "PageController::login");
$router->get("registration", "PageController::registration");

$router->post("api/v1/login", "AuthController::login");
$router->post("api/v1/registration", "AuthController::registration");