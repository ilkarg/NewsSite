<?php

// Подключение системных библиотек
include __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/app/PHPTemplater/Template.php';
include __DIR__ . '/app/PHPView/View.php';
include __DIR__ . '/app/PHPRequester/Request.php';
include __DIR__ . '/app/PHPHash/Hash.php';

// Подключение системных пространств имен
use PHPTemplater\Template;
use PHPRequester\Request;
use Pecee\SimpleRouter\SimpleRouter;

// Создание системных объектов
$request = new Request();

// Подключение файла для подключения к БД
include __DIR__ . '/database/bootstrap.php';

// Подключение контроллеров
include __DIR__ . '/controllers/PageController.php';
include __DIR__ . '/controllers/AuthController.php';
include __DIR__ . '/controllers/PostController.php';
include __DIR__ . '/controllers/CommentController.php';

// Подключение файла с маршрутами
include __DIR__ . '/routes/web.php';

SimpleRouter::start();