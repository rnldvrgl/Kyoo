<?php

// Landing Page
$router->get('/', 'controllers/index.php');
$router->get('/frequent-questions', 'controllers/frequent-questions.php');

// Login Page
$router->get('/login', 'controllers/auth/login.php');
$router->post('/login', 'controllers/auth/authenticate.php');


// Live Queue Page
$router->get('/live-queue', 'controllers/live-queue.php');
