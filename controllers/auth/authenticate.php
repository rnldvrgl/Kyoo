<?php
// * For Login Process

use Core\App;

use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$validator = App::resolve(Validator::class);

// CSRF Token Validation
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
	$_SESSION['msg'] = "Invalid Email Address or Password!";
	$_SESSION['alert_type'] = "alert-danger";
	redirect('/login');
}

// Check if empty
if (empty($_POST['email']) || empty($_POST['password'])) {
	$_SESSION['msg'] = "Invalid Email Address or Password!";
	$_SESSION['alert_type'] = "alert-danger";
	redirect('/login');
}

// Validate inputs
$email = $validator->email($_POST['email']);
$password = $validator->loginPassword($_POST['password']);

// Get the login_id using the given Email Address 
$account_login = $db->query('SELECT * FROM account_login WHERE email = :email', [
	'email' => $email,
])->get();

// Count the number of rows returned by the database query
$count = count($account_login);

// Check if there is a result
if ($count > 0) {
	foreach ($account_login as $data) {
		$login_id = $data['login_id'];
		$passwordCheck = password_verify($password, $data['password']);
	}
} else {
	$_SESSION['msg'] = "Invalid Email Address or Password!";
	$_SESSION['alert_type'] = "alert-danger";
	redirect('/login');
}

// Get the user's account_id from accounts table using the login_id
$accounts = $db->query('SELECT * FROM accounts WHERE login_id = :login_id', [
	'login_id' => $login_id,
])->get();

foreach ($accounts as $account) {
	$account_id = $account['account_id'];
}

// Verify if the password from the database matches the password from what the user entered
if ($passwordCheck !== FALSE) {
	$_SESSION['sid'] = session_id();
	$_SESSION['account_id'] = $account_id;

	// Redirect to secure-page.php for Redirection to the Dashboard
	redirect('/login/authenticate');
}

// If passwords doesn't match, redirect to login page
$_SESSION['msg'] = "Invalid Email Address or Password!";
$_SESSION['alert_type'] = "alert-danger";
redirect('/login');
