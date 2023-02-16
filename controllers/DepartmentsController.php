<?php
// * For Login Process

session_start();

use Core\Validator;
use Core\Database;

// For the Functions
require '../Core/functions.php';

// Validator Class
require base_path('Core/Validator.php');

// Database Class
require base_path('Core/Database.php');

// require connection to the database
$config = require base_path('config/connection.php');

// instantiate the database
$db = new Database($config['database']);

// TODO: VIEW DATA, PWEDE GAMITIN YUNG FETCH NA ACTION SINCE PAREHAS LANG KINUKUHA

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
		// If not empty
		if (!empty($dept_name) || !empty($dept_desc)) {
			$db->query('INSERT INTO departments(dept_name, dept_desc, status) VALUES (:dept_name, :dept_desc, :status)', [
				'dept_name' => $dept_name,
				'dept_desc' => $dept_desc,
				'status' => $status
			]);
			$_SESSION['msg'] = "Department added successfully!";
			$_SESSION['alert_type'] = "alert-success";
			redirect('../pages/departments/main-admin/departments.php');
		} else {
			// if empty
			$_SESSION['msg'] = "There are missing required fields!";
			$_SESSION['alert_type'] = "alert-danger";
			redirect('../pages/departments/main-admin/departments.php');
		}
	}
} else if ($_POST['action'] == "Fetch") {
	// For Updating Department
	$id = Validator::validate($_POST['id']);

	$dept_details = $db->query("SELECT * FROM departments WHERE dept_id = :dept_id", [
		'dept_id' => $id,
	])->get();

	foreach ($dept_details as $data) {
		$department_details[] = $data;
	}

	echo json_encode($department_details);

	// No redirect since AJAX request i2 hehe
} else if ($_POST['action'] == "Update") {
	// Get the formData string from $_POST
	$formData = $_POST['formData'];

	// Parse the formData string into an associative array
	$data = array();
	parse_str($formData, $data);

	// Data from the formData array
	$id = Validator::validate($data['id']);
	$dept_name = Validator::validate($data['dept-name']);
	$dept_desc = Validator::validate($data['dept-desc']);
	$status = Validator::validate($data['status']);

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

	// No redirect since AJAX request i2 hehe
} else if ($_GET['action'] == "Delete") {
	// For Deleting Department
	$id = Validator::validate($_GET['id']);

	$db->query('DELETE FROM departments WHERE dept_id = :dept_id', [
		'dept_id' => $id,
	]);

	$_SESSION['msg'] = "Department has been deleted successfully!";
	$_SESSION['alert_type'] = "alert-danger";
	redirect('../pages/departments/main-admin/departments.php');
} else {
	redirect('../pages/departments/main-admin/departments.php');
}
