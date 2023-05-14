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
        $user = R::find("users", "login = ? AND password = ?", [$login, Hash::sha256($password, "", 1)]);
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

    public static function addPostQuery(string $title, string $body, string $tag, string $publicationTime, string $image) {
        global $orm;
        $orm->connect();
        $post = R::dispense("posts");
        $post->title = $title;
        $post->body = $body;
        $post->tag = $tag;
        $post->publication_time = $publicationTime;
        $post->image = $image;
        R::store($post);
        return json_encode(array("response" => "Пост успешно создан"));
    }

    public static function getAllPostsQuery() {
        global $orm;
        $orm->connect();
        $posts = R::findAll("posts");
        if ($posts == null) {
            return json_encode(array("response" => "Посты не найдены"));
        }
        return json_encode($posts);
    }

    public static function getPostByIdQuery(int $id) {
        global $orm;
        $orm->connect();
        $post = R::find("posts", "id = ?", [$id]);
        if ($post == null) {
            return json_encode(array("response" => "Указанный пост не найден"));
        }
        return json_encode($post);
    }

    public static function getPostsByTagQuery(string $tag) {
        global $orm;
        $orm->connect();
        $posts = R::find("posts", "tag = ?", [$tag]);
        if ($posts == null) {
            return json_encode(array("response" => "Посты не найдены"));
        }
        return json_encode($posts);
    }

    public static function getLastPostIdQuery() {
        global $orm;
        $orm->connect();
        $post = R::findLast("posts");
        return json_encode(array("id" => $post->id));
    }

    public static function addCommentQuery(string $login, string $publicationTime, string $text, int $postId) {
        session_start();
        global $orm;
        $orm->connect();
        $comment = R::dispense("comments");
        $comment->login = $login;
        $comment->publication_time = $publicationTime;
        $comment->text = $text;
        $comment->post_id = $postId;
        R::store($comment);
        return json_encode(
            array(
                "response" => "Комментарий успешно добавлен",
                "login" => $_SESSION["user"]->login
            )
        );
    }

    public static function getCommentsQuery(int $postId) {
        session_start();
        global $orm;
        $orm->connect();
        $comments = R::find("comments", "post_id = ?", [$postId]);
        if ($comments == null) {
            return json_encode(
                array(
                    "response" => "Comments not found",
                    "login" => $_SESSION["user"]->login
                )
            );
        }
        return json_encode(
            array(
                "login" => $_SESSION["user"]->login,
                "comments" => $comments
            )
        );
    }
}