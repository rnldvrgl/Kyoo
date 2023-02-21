<?php

// Landing Page
$router->get('/', 'controllers/index.php');
$router->get('/frequent-questions', 'controllers/frequent-questions.php');

// Login Page
$router->get('/login', 'controllers/auth/index.php');
$router->post('/login', 'controllers/auth/authenticate.php');
$router->get('/login/authenticate', 'controllers/auth/secure-page.php');

// Live Queue Page
$router->get('/live-queue', 'controllers/live-queue.php');

// Dashboard Page
$router->get('/dashboard', 'controllers/dashboard.php');

// User Profile Page
$router->get('/user-profile', 'controllers/user-profile.php');

// Departments Page
$router->get('/departments', 'controllers/main-admin/departments/index.php');
$router->post('/departments', 'controllers/main-admin/departments/store.php');
$router->post('/fetch-dept', 'controllers/main-admin/departments/show.php');
// TODO: Fix the Delete Feature once nag-Upload na si Jeffrey Way regarding wildcards
$router->delete('/departments', 'controllers/main-admin/departments/destroy.php');
$router->patch('/department/update', 'controllers/main-admin/departments/update.php');

// Services Page

// FAQ Page

// Accounts Page
$router->get('/accounts', 'controllers/main-admin/accounts/index.php');

// Error Page
$router->get('/404', 'controllers/error.php');

// Logout Page
$router->get('/logout', 'controllers/auth/logout.php');
