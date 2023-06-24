<?php

require __DIR__ . "/../models/User.php";

use PHPSystem\System;
use PHPHash\Hash;
use Models\User;

class AuthController {
	public function registration() {
        session_start();
        if (isset($_SESSION["user"])) {
            echo json_encode([
                "response" => "Вы уже находитесь в аккаунте"
            ]);
            return;
        }
        $data = System::getRequestData();
        if ($data->password != $data->repeatPassword) {
            echo json_encode([
                "response" => "Пароль и повтор пароля не совпадают"
            ]);
            return;
        }
        $user = User::create([
            "login" => $data->login,
            "password" => Hash::sha256($data->password, "", 1)
        ]);
        $_SESSION["user"] = $user;
        echo json_encode([
            "response" => "OK"
        ]);
    }

    public function login() {
        session_start();
        if (isset($_SESSION["user"])) {
            echo json_encode([
                "response" => "Вы уже находитесь в аккаунте"
            ]);
            return;
        }
        $data = System::getRequestData();
        $user = User::where([
            ["login", "=", $data->login],
            ["password", "=", Hash::sha256($data->password, "", 1)]
        ])->first();

        if ($user) {
            $_SESSION["user"] = $user;
            echo json_encode([
                "response" => "Вы успешно вошли в аккаунт"
            ]);
            return;
        }

        echo json_encode([
            "response" => "Неверные логин или пароль"
        ]);
    }

    public function logout() {
        session_start();
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            echo json_encode([
                "response" => "Вы успешно вышли из аккаунта"
            ]);
        } else {
            echo json_encode([
                "response" => "Вы и так не находитесь в аккаунте"
            ]);
        }
    }

    public function isAdmin() {
        session_start();
        if (isset($_SESSION["user"]) && $_SESSION["user"]->login == "admin") {
            echo json_encode(array("response" => "admin"));
        } else {
            echo json_encode(array("response" => "not_admin"));
        }
    }

    public function isAuthorized() {
        session_start();
        echo json_encode([
            "response" => isset($_SESSION["user"])
        ]);
    }
}