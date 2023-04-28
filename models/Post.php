<?php

class Post extends Model {
	public string $title;
    public string $body;

    public function __construct(string $title, string $body) {
        $this->title = $title;
        $this->body = $body;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getBody() : string {
        return $this->body;
    }
}