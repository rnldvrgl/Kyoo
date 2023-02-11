<?php

const BASE_PATH = __DIR__ . '/../Kyoo/';

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function redirect($path)
{
    header("Location: " . $path);
    exit();
}
