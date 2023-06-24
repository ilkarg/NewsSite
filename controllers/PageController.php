<?php

use PHPTemplater\Template;
use PHPView\View;
use PHPExceptionHandler\ExceptionHandler;

class PageController {
	public function index() {
		$template = new Template(__DIR__ . "/../pages/index.html");
        echo View::createFromTemplate($template);
	}

	public function login() {
		$template = new Template(__DIR__ . "/../pages/login.html");
		echo View::createFromTemplate($template);
	}

	public function registration() {
		$template = new Template(__DIR__ . "/../pages/registration.html");
		echo View::createFromTemplate($template);
	}

	public function posts(string $tag) {
		$template = new Template(__DIR__ . "/../pages/posts.html");
		echo View::createFromTemplate($template);
	}

	public function post(string $id) {
		$template = new Template(__DIR__ . "/../pages/post.html");
		echo View::createFromTemplate($template);
	}
}