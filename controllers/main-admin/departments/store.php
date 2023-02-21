<?php

use Core\App;

use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$validator = App::resolve(Validator::class);

// CSRF Token Validation
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // Error Message
    $_SESSION['msg'] = "Invalid or Missing CSRF Token";
    $_SESSION['alert_type'] = "alert-danger";

    // Redirect
    redirect('/departments');
}

// Validate inputs
$dept_name = $validator->validate($_POST['dept-name']);
$dept_desc = $validator->validate($_POST['dept-desc']);
$status = $validator->validate($_POST['status']);

// Check if empty
if (empty($dept_name) || empty($dept_desc) || empty($status)) {
    // Error Message
    $_SESSION['msg'] = "Please fill all required fields";
    $_SESSION['alert_type'] = "alert-warning";

    // Redirect
    redirect('/departments');
}

// See if there is an existing Department
$dept_name_from_db = $db->query('SELECT dept_name FROM departments WHERE dept_name = :dept_name', [
    'dept_name' => $dept_name,
])->get();

// If there is an existing Department
if (count($dept_name_from_db) > 0) {
    // Error Message
    $_SESSION['msg'] = "Department already exists";
    $_SESSION['alert_type'] = "alert-warning";

    // Redirect
    redirect('/departments');
}

// Insert the new Department
$db->query('INSERT INTO departments(dept_name, dept_desc, status) VALUES (:dept_name, :dept_desc, :status)', [
    'dept_name' => $dept_name,
    'dept_desc' => $dept_desc,
    'status' => $status
]);

// Success Message
$_SESSION['msg'] = "Department added successfully";
$_SESSION['alert_type'] = "alert-success";

// Redirect
redirect('/departments');
