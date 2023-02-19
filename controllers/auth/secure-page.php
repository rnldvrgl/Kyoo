<?php
/*
    * For Secure Logins

    ? Redirect Pages here
*/

use Core\App;

use Core\Database;

if ($_SESSION['sid'] === session_id()) {

	$db = App::resolve(Database::class);

	$_SESSION['authorized'] = TRUE;

	$account_id = $_SESSION['account_id'];

	$info = $db->query("SELECT * FROM accounts WHERE account_id = :account_id", [
		'account_id' => $account_id,
	])->get();

	foreach ($info as $ids) {
		$role_id = $ids['role_id'];
		$dept_id = $ids['dept_id'];
	}

	/*
    Redirect to their respective home page

    * Departments
    ? 1 = Office, 2 = Registrar, 3 = Cashier, 4 = Library

     * Roles
    ? 1 = Main Admin, 2 = Department Admin, 3 = Staff, 4 = Librarian
     */

	//  !! Anong mas optimal na way para mag redirect?

	if ($dept_id == 1) {
		if ($role_id == 1) {
			redirect('../pages/departments/main-admin/dashboard.php');
		}
	} else if ($dept_id == 2) {
		if ($role_id == 2) {
			redirect('../pages/departments/department-admin/dashboard.php');
		} else if ($role_id == 3) {
			redirect('../pages/departments/staff/dashboard.php');
		}
	} else if ($dept_id == 3) {
		if ($role_id == 2) {
			redirect('../pages/departments/department-admin/dashboard.php');
		} else if ($role_id == 3) {
			redirect('../pages/departments/staff/dashboard.php');
		}
	} else if ($dept_id == 4) {
		if ($role_id == 4) {
			redirect('../pages/departments/library/dashboard.php');
		}
	}
} else {
	$_SESSION['authorized'] = FALSE;

	redirect('../pages/error/404.php');
}

// view("auth/login.view.php", [
//     'title' => 'Kyoo: Login',
// ]);