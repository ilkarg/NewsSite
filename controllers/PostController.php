<?php

require __DIR__ . "/../models/Post.php";

use PHPSystem\System;
use Models\Post;

class PostController {
    public function addPost() {
        copy($_FILES["image"]["tmp_name"], __DIR__ . "/../pages/post_images/" . $_FILES["image"]["name"]);
        $post = Post::create([
            "title" => $_POST["title"],
            "body" => $_POST["body"],
            "tag" => $_POST["tag"],
            "publication_time" => $_POST["publicationTime"],
            "image" => "/pages/post_images/" . $_FILES["image"]["name"]
        ]);
        echo json_encode([
            "response" => "Пост успешно создан",
            "id" => $post->id
        ]);
    }

    public function getPostById(int $id) {
        $post = Post::find($id);
        if ($post == null) {
            echo json_encode([
                "response" => "Указанный пост не найден"
            ]);
            return;
        }
        echo json_encode($post);
    }

    public function getPostsByTag(string $tag) {
        $posts = Post::where("tag", $tag)->get();
        if ($posts) {
            echo json_encode($posts);
            return;
        }
        echo json_encode([
            "response" => "Посты не найдены"
        ]);
    }

	public function getAllPosts() {
        $posts = Post::all();
        if ($posts) {
            echo json_encode($posts);
            return;
        }
        echo json_encode([
            "response" => "Посты не найдены"
        ]);
    }

    public function getPostGroup(string $tag) {
        $posts = Post::where([
            ["tag", "=", $tag]
        ])->get();
        if ($posts) {
            echo json_encode($posts);
            return;
        }
        echo json_encode([
            "response" => "Посты не найдены"
        ]);
    }
}