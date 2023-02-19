<?php

// Landing Page
$router->get('/', 'controllers/index.php');
$router->get('/frequent-questions', 'controllers/frequent-questions.php');

$router->get('/login', 'controllers/auth/login.php');
$router->post('/login', 'controllers/auth/authenticate.php');
