<?php

include __DIR__ . '/../models/User.php';

use PHPSystem\System;

class AuthController {
	public static function login() {
        global $router, $orm;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $user_model = new User($data["login"], $data["password"]);
            $orm->connect();
            $user = R::find("users", "BINARY login = ? AND password = ?", [$user_model->login, md5($user_model->password)]);
            if ($user == null) {
                echo json_encode(array("response" => "Неверные логин или пароль"));
            } else {
                echo json_encode($user[1]);
            }
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function registration() {
        global $router, $orm;
        $data = $router->getPostRouteData();
        if ($data != null) {
            if ($data["password"] == $data["repeatPassword"]) {
                $user_model = new User($data["login"], md5($data["password"]));
                $orm->connect();
                $user = R::dispense('users');
                $result = $user_model->validate();
                if ($result["status"]) {
                    $user->login = $user_model->login;
                    $user->password = $user_model->password;
                    try {
                        R::store($user);
                    } catch (RedBeanPHP\RedException\SQL $except) {
                        if (System::startsWith($except->getMessage(), "SQLSTATE[23000]: Integrity constraint violation")) {
                            echo json_encode(array("response" => "User already exists"));
                            return;
                        }
                    }
                    echo json_encode(array("response" => "OK"));
                } else {
                    echo json_encode(array("response" => $result["message"]));
                }
            } else {
                echo json_encode(array("response" => "Password and repeat password do not match"));
            }
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }
}