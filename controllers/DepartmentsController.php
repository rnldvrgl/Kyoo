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


if (isset($_POST['add-dept'])) {
	// For Adding Department
	$dept_name = Validator::validate($_POST['dept-name']);
	$dept_desc = Validator::validate($_POST['dept-desc']);
	$status = Validator::validate($_POST['status']);

	// See if there is an existing department
	$dept_name_from_db = $db->query('SELECT dept_name FROM departments WHERE dept_name = :dept_name', [
		'dept_name' => $dept_name,
	])->get();

	if (count($dept_name_from_db) > 0) {
		$_SESSION['msg'] = "Department already exists!";
		$_SESSION['alert_type'] = "alert-warning";
		redirect('../pages/departments/main-admin/departments.php');
	} else {
		$db->query('INSERT INTO departments(dept_name, dept_desc, status) VALUES (:dept_name, :dept_desc, :status)', [
			'dept_name' => $dept_name,
			'dept_desc' => $dept_desc,
			'status' => $status
		]);
		$_SESSION['msg'] = "Department added successfully!";
		$_SESSION['alert_type'] = "alert-success";
		redirect('../pages/departments/main-admin/departments.php');
	}
} else if ($_GET['action'] == "Update") {
	// For Updating Department
	$id = $_GET['id'];

	// TODO: Update
} else if ($_GET['action'] == "Delete") {
	// For Deleting Department
	$id = $_GET['id'];

	$db->query('DELETE FROM departments WHERE dept_id = :dept_id', [
		'dept_id' => $id,
	]);

	$_SESSION['msg'] = "Department has been deleted successfully!";
	$_SESSION['alert_type'] = "alert-danger";
	redirect('../pages/departments/main-admin/departments.php');
} else {
	redirect('../pages/departments/main-admin/departments.php');
}
