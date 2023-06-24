<?php

use Pecee\SimpleRouter\SimpleRouter as Route;

Route::get("/", [PageController::class, "index"]);
Route::get("/login", [PageController::class, "login"]);
Route::get("/registration", [PageController::class, "registration"]);
Route::get("/posts/{tag}", [PageController::class, "posts"]);
Route::get("/post/{id}", [PageController::class, "post"]);

Route::group(["prefix" => "api/v1"], function() {
	Route::post("/login", [AuthController::class, "login"]);
	Route::post("/registration", [AuthController::class, "registration"]);
	Route::post("/logout", [AuthController::class, "logout"]);

	Route::get("/isAuthorized", [AuthController::class, "isAuthorized"]);
	Route::get("/isAdmin", [AuthController::class, "isAdmin"]);

	Route::post("/addPost", [PostController::class, "addPost"]);

	Route::get("/getPosts", [PostController::class, "getPosts"]);
	Route::get("/getAllPosts", [PostController::class, "getAllPosts"]);
	Route::get("/getPostById/{id}", [PostController::class, "getPostById"]);
	Route::get("/getPostsByTag/{tag}", [PostController::class, "getPostsByTag"]);

	Route::post("/addComment", [CommentController::class, "addComment"]);

	Route::get("/getComments/{id}", [CommentController::class, "getComments"]);
});