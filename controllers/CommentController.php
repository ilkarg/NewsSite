<?php

include __DIR__ . "/../models/Comment.php";

use PHPSystem\System;
use Models\Comment;

class CommentController {
    public function addComment() {
        session_start();
        $data = System::getRequestData();
        Comment::create([
            "login" => $data->login,
            "publication_time" => $data->publicationTime,
            "text" => $data->text,
            "post_id" => $data->postId
        ]);
        echo json_encode([
            "response" => "Комментарий успешно добавлен",
            "login" => isset($_SESSION["user"]) ? $_SESSION["user"]->login : null
        ]);
    }

    public function getComments(int $id) {
        session_start();
        $comments = Comment::where([
            ["post_id", "=", $id]
        ])->get();
        if ($comments) {
            echo json_encode([
                "comments" => $comments,
                "login" => isset($_SESSION["user"]) ? $_SESSION["user"]->login : null
            ]);
            return;
        }
        echo json_encode([
            "response" => "Комментарии не найдены"
        ]);
    }
}