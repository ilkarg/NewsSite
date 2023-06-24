<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	protected $table = "comments";
    protected $fillable = [
        "login",
        "publication_time",
        "text",
        "post_id"
    ];
    public $timestamps = false;
}