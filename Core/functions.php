<?php

use Core\Response;

// Local Server Root
define('ROOT', 'http://localhost/Kyoo/public');

// Deployed Server Root
// define('ROOT', 'https://www.websitename.com');

// For file linking (require and include)
function base_path($path)
{
	return BASE_PATH . $path;
}

// Redirecting
function redirect($path)
{
	header("Location: " . $path);
	exit();
}

// For href/src
function path($path)
{
	return "/../KyooMVC/" . $path;
}

// Die and Dump
function dd($value)
{
	echo "<pre>";
	var_dump($value);
	echo "</pre>";

	die();
}

// Get URI
function urlIs($value)
{
	return $_SERVER['REQUEST_URI'] === $value;
}

// Abort 
function abort($code = 404)
{
	http_response_code($code);

	require base_path("resources/views/errors/{$code}.php");

	die();
}

// Authorize
function authorize($condition, $status = Response::FORBIDDEN)
{
	if (!$condition) {
		abort($status);
	}

	return true;
}

// Views
function view($path, $attributes = [])
{
	extract($attributes);

	require base_path('resources/views/' . $path);
}
