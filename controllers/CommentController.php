<?php

include __DIR__ . "/../models/Comment.php";

class CommentController {
	public static function addComment() {
        session_start();
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $comment_model = new Comment(
                $_SESSION["user"]->login,
                $data["publicationTime"],
                $data["text"],
                $data["postId"]
            );
            $comment = QueryController::addCommentQuery(
                $comment_model->login,
                $comment_model->publicationTime,
                $comment_model->text,
                $comment_model->postId
            );
            echo $comment;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function getComments() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $comments = QueryController::getCommentsQuery($data["postId"]);
            echo $comments;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }
}