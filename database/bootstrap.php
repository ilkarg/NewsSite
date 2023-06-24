<?php

namespace Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Orm {
    function __construct() {
        $capsule = new Capsule();
        $capsule->addConnection([
            "driver" => "sqlite",
            "database" => __DIR__ . "/../db/news_site.db"
        ]);
        $capsule->bootEloquent();
    }
}

$orm = new Orm();