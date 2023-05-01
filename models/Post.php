<?php

class Post extends Model {
	public string $title;
    public string $body;
    public string $tag;
    public string $publicationTime;
    public $image;

    public function __construct(string $title, string $body, string $tag, string $publicationTime, $image) {
        $this->title = $title;
        $this->body = $body;
        $this->tag = $tag;
        $this->publicationTime = $publicationTime;
        $this->image = $image;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getBody() : string {
        return $this->body;
    }

    public function getTag() : string {
        return $this->tag;
    }

    public function getPublicationTime() : string {
        return $this->publicationTime;
    }

    public function getImage() {
        return $this->image;
    }
}