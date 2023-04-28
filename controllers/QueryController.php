<?php

use PHPSystem\System;
use PHPHash\Hash;

class QueryController {
	public static function loginQuery(string $login, string $password) {
        session_start();
        if (isset($_SESSION["user"])) {
            return json_encode(array("response" => "Вы уже находитесь в аккаунте"));
        }
        global $orm;
        $orm->connect();
        $user = R::find("users", "BINARY login = ? AND password = ?", [$login, Hash::sha256($password, "", 1)]);
        $user = $user[array_key_first($user)];
        if ($user == null) {
            return json_encode(array("response" => "Неверные логин или пароль"));
        }
        $_SESSION["user"] = $user;
        return json_encode(array("response" => "Вы успешно вошли в аккаунт"));
    } 

    public static function registrationQuery(string $login, string $password) {
        session_start();
        if (isset($_SESSION["user"])) {
            return json_encode(array("response" => "Вы уже находитесь в аккаунте"));
        }
        global $orm;
        $orm->connect();
        $user = R::dispense("users");
        $user->login = $login;
        $user->password = Hash::sha256($password, "", 1);
        try {
            R::store($user);
            $_SESSION["user"] = $user;
        } catch (RedBeanPHP\RedException\SQL $except) {
            if (System::startsWith($except->getMessage(), "SQLSTATE[23000]: Integrity constraint violation")) {
                return json_encode(array("response" => "User already exists"));
            }
        }
        return json_encode(array("response" => "OK"));
    }

    public static function addPostQuery(string $title, string $body) {
        global $orm;
        $orm->connect();
        $post = R::dispense("posts");
        $post->title = $title;
        $post->body = $body;
        R::store($post);
        return json_encode(array("response" => "Пост успешно создан"));
    }

    public static function getPostsQuery() {
        global $orm;
        $orm->connect();
        $posts = R::findAll("posts");
        if ($posts == null) {
            return json_encode(array("response" => "Посты не найдены"));
        }
        return json_encode($posts);
    }
}