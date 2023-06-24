<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Post extends Model {
	protected $table = "posts";
    protected $fillable = [
        "title",
        "body",
        "tag",
        "publication_time",
        "image"
    ];
    public $timestamps = false;
}