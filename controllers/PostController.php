<?php

include __DIR__ . "/../models/Post.php";

class PostController {
    public static function addPost() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            copy($_FILES["image"]["tmp_name"], __DIR__ . "/../pages/post_images/" . $_FILES["image"]["name"]);
            $post_model = new Post($data["title"], $data["body"], $data["tag"], $data["publicationTime"], "/pages/post_images/" . $_FILES["image"]["name"]);
            $post = QueryController::addPostQuery(
                $post_model->title, 
                $post_model->body,
                $post_model->tag,
                $post_model->publicationTime,
                $post_model->image
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

    public static function getLastPostId() {
        $id = QueryController::getLastPostId();
        echo $id;
    }
}