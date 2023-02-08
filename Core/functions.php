<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path)
{
    return dirname(__DIR__) . $path;
}

function redirect($path)
{
    header("Location: " . $path);
    exit();
}
