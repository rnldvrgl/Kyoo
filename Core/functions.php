<?php

const BASE_PATH = __DIR__ . '/../';

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

// For file linking (require and include)
function base_path($path)
{
    return BASE_PATH . $path;
}

function redirect($path)
{
    header("Location: " . $path);
    exit();
}

// For href/src
function path($path)
{
    echo "/../Kyoo/" . $path;
}
