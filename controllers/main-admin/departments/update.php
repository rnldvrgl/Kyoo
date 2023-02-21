<?php

use Core\App;

use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$validator = App::resolve(Validator::class);

// Get the formData string from $_POST
$formData = $_POST['formData'];

// Parse the formData string into an associative array
$data = array();
parse_str($formData, $data);

// CSRF Token Validation
if (!isset($data['csrf_token']) || $data['csrf_token'] !== $_SESSION['csrf_token']) {
    // Error Message
    $_SESSION['msg'] = "Invalid or Missing CSRF Token";
    $_SESSION['alert_type'] = "alert-danger";

    // Redirect
    redirect('/departments');
}

// Data from the formData array
$id = $validator->validate($data['id']);
$dept_name = $validator->validate($data['dept_name']);
$dept_desc = $validator->validate($data['dept_desc']);
$status = $validator->validate($data['status']);

// Update Query
$db->query('UPDATE departments SET dept_name = :dept_name, dept_desc = :dept_desc, status = :status WHERE dept_id = :dept_id', [
    'dept_name' => $dept_name,
    'dept_desc' => $dept_desc,
    'status' => $status,
    'dept_id' => $id
]);

// Message
$_SESSION['msg'] = "Department updated successfully!";
$_SESSION['alert_type'] = 'alert-success';
