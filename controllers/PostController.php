<?php

include __DIR__ . "/../models/Post.php";

class PostController {
    public static function addPost() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $post_model = new Post($data["title"], $data["body"], $data["tag"], $data["publicationTime"]);
            $post = QueryController::addPostQuery(
                $post_model->title, 
                $post_model->body,
                $post_model->tag,
                $post_model->publicationTime
            );
            echo $post;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function getPostById() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $post = QueryController::getPostByIdQuery($data["id"]);
            echo $post;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

    public static function getPostsByTag() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $posts = QueryController::getPostsByTagQuery($data["tag"]);
            echo $posts;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

	public static function getPosts() {
        $posts = QueryController::getPostsQuery();
        echo $posts;
    }
}