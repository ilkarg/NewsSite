<?php

class Comment extends Model {
	public string $login;
    public string $publicationTime;
    public string $text;
    public int $postId;

    public function __construct(string $login, string $publicationTime, string $text, int $postId) {
        $this->login = $login;
        $this->publicationTime = $publicationTime;
        $this->text = $text;
        $this->postId = $postId;
    }

    public function getLogin() : string {
        return $this->login;
    }

    public function getPublicationTime() : string {
        return $this->publicationTime;
    }

    public function getText() : string {
        return $this->text;
    }

    public function getPostId() : int {
        return $this->postId;
    }
}