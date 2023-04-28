<?php

include __DIR__ . "/../models/Post.php";

class PostController {
    public static function addPost() {
        global $router;
        $data = $router->getPostRouteData();
        if ($data != null) {
            $post_model = new Post($data["title"], $data["body"]);
            $post = QueryController::addPostQuery($post_model->title, $post_model->body);
            echo $post;
        } else {
            echo json_encode(array("response" => "Данные не дошли или неверные имена полей"));
        }
    }

	public static function getPosts() {
        $posts = QueryController::getPostsQuery();
        echo $posts;
    }
}