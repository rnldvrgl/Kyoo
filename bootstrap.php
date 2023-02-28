<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Container;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('config/connection.php');

    return new Database($config['database']); // New instance of the Database class
});

$container->bind('Core\Validator', function () {
    return new Validator();
});

App::setContainer($container);
