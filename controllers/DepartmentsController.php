<?php
// * For Login Process

session_start();

use Core\Validator;
use Core\Database;

require '../Core/functions.php';

// Validator Class
require '../Core/Validator.php';

// Database Class
require '../Core/Database.php';

// require connection to the database
$config = require '../config/connection.php';

// instantiate the database
$db = new Database($config['database']);

// For Adding 
if (isset($_POST['add-dept'])) {
    $dept_name = Validator::validate($_POST['dept-name']);
    $dept_desc = Validator::validate($_POST['dept-desc']);
    $status = Validator::validate($_POST['status']);

    if (empty($dept_name) || empty($dept_desc) || empty($status)) {
        $_SESSION['msg'] = "Fill in all required fields";
        redirect('../pages/departments/main-admin/departments.php');
    } else {
        $db->query('INSERT INTO departments(dept_name, dept_desc, status) VALUES (:dept_name, :dept_desc, :status)', [
            'dept_name' => $dept_name,
            'dept_desc' => $dept_desc,
            'status' => $status
        ]);
        $_SESSION['msg'] = "Successfully Added!";
        redirect('../pages/departments/main-admin/departments.php');
    }
}
