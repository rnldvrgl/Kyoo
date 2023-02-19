<?php
// * For Login Process

use Core\App;

use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$validator = App::resolve(Validator::class);

$errors = [];

// Check if empty
if (empty($_POST['email']) || empty($_POST['password'])) {
	// Put message
	$error['emptyfields'] = "Email and Password are required!";
}

if (count($errors)) {
	return view('auth/login.view.php', [
		'title' => 'Kyoo: Login',
		'errors' => $errors,
	]);
}

$email = $validator->email($_POST['email']);

dd($email);

$email = $_POST['email'];

// Get the login_id 
$account_login = $db->query('SELECT * FROM account_login WHERE email = :email', [
	'email' => $email,
])->get();

// Count the number of rows returned by the database query
$count = count($account_login);

dd($count);


// if (isset($_POST['submit']) && !empty($_POST['email'] && !empty($_POST['password']))) {

// 	$db = App::resolve(Database::class);

// 	App::resolve(Validator::class);

// 	$email = Validator::email($_POST['email']);
// 	$password = Validator::loginPassword($_POST['password']);

// 	if (!empty($email) && !empty($password)) {

// 		// Get the login_id 
// 		$account_login = $db->query('SELECT * FROM account_login WHERE email = :email', [
// 			'email' => $email,
// 		])->get();

// 		// Count the number of rows returned by the database query
// 		$count = count($account_login);

// 		// Check if there is an email in the database that matches the email address that the user entered in the form
// 		if ($count > 0) {
// 			foreach ($account_login as $data) {
// 				$login_id = $data['login_id'];
// 				$passwordCheck = password_verify($password, $data['password']);
// 			}

// 			// Get the user's account_id from accounts table using the login_id
// 			$accounts = $db->query('SELECT * FROM accounts WHERE login_id = :login_id', [
// 				'login_id' => $login_id,
// 			])->get();

// 			foreach ($accounts as $account) {
// 				$account_id = $account['account_id'];
// 			}

// 			// Verify if the password from the database matches the password from what the user entered
// 			if ($passwordCheck !== FALSE) {
// 				$_SESSION['sid'] = session_id();
// 				$_SESSION['account_id'] = $account_id;

// 				redirect('secure-page.php');
// 			} else {
// 				// If passwords doesn't match, redirect to login page
// 				$_SESSION['err'] = 'Invalid Email or Password!';
// 				redirect('../pages/auth/login.php');
// 			}
// 		} else {
// 			// If no email address found, redirect to login page
// 			$_SESSION['err'] = 'Invalid Email or Password!';
// 			redirect('../pages/auth/login.php');
// 		}
// 	} else {
// 		// If empty email address and password, redirect to login page
// 		redirect('../pages/auth/login.php');
// 	}
// } else {
// 	// Access 404.php
// 	redirect('../pages/error/404.php');
// }
