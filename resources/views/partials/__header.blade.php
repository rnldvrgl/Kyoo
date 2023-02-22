<?php

// See login.php
$account_id = $_SESSION['account_id'];

// Query to fetch all user-related information from the database
$accounts = $db->query("SELECT * FROM accounts WHERE account_id = :account_id", [
	'account_id' => $account_id,
])->get();

// Loop to get the data inside accounts table
foreach ($accounts as $a) {
	// id for account_details table
	$user_id = $a['user_id'];

	// id for account_login table
	$login_id = $a['login_id'];

	// id for account_role table
	$role_id = $a['role_id'];

	// id for departments table
	$dept_id = $a['dept_id'];
}

// Query to fetch data from account_details table
$account_details = $db->query("SELECT * FROM account_details WHERE user_id = :user_id", [
	'user_id' => $user_id,
])->get();

// Loop to get the data inside accounts_details table
foreach ($account_details as $ad) {
	$name = $ad['name'];
	$address = $ad['address'];
	$phone = $ad['phone'];
	$about = $ad['about'];
}

// Query to fetch data from account_login table
$account_login = $db->query('SELECT * FROM account_login WHERE login_id = :login_id', [
	'login_id' => $login_id,
])->get();

// Loop to get the data inside accounts_login table
foreach ($account_login as $al) {
	$email = $al['email'];
	$password = $al['password'];
}

// Query to fetch data from account_role table
$account_roles = $db->query('SELECT * FROM account_role WHERE role_id = :role_id', [
	'role_id' => $role_id,
])->get();

// Loop to get the data inside accounts_role table
foreach ($account_roles as $ar) {
	$role = $ar['role_name'];
}

// Query to fetch data from departments table
$departments = $db->query('SELECT * FROM departments WHERE dept_id = :dept_id', [
	'dept_id' => $dept_id,
])->get();

// Loop to get the data inside departments table
foreach ($departments as $d) {
	$dept_name = $d['dept_name'];
	$dept_desc = $d['dept_desc'];
	$status = $d['status'];
}

// Get Date and Day of the Week
$date = date('F j, Y');
$dayOfWeek = date('l', strtotime($date));
?>

<!-- Header Navbar -->
<header id="header" class="header fixed-top d-flex align-items-center bg-kyoodark">
	<div class="d-flex align-items-center justify-content-between">
		<a href="#" class="logo d-flex align-items-center">
			<img src="/images/kyoo-logo.png" alt="" />
			<span class="d-none d-lg-block">Queueing Management System</span>
		</a>
		<i class="fa-solid fa-bars toggle-sidebar-btn"></i>
	</div>
	<nav class="header-nav ms-auto">
		<ul class="d-flex align-items-center">
			<li class="nav-item d-none d-md-block datetime pe-3 text-center">
				<h6 class="day mb-0"><?= $dayOfWeek ?></h6>
				<span class="date"><?= $date ?></span>
			</li>
			<li class=" nav-item dropdown pe-3">
				<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
					<img src="images/profile-img.jpg" alt="Profile" class="rounded-circle" />
					<span class="d-none d-md-block dropdown-toggle ps-2"><?= $name ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
					<li class="dropdown-header">
						<h6><?= $name ?></h6>
						<span><?= $role ?></span>
					</li>
					<li>
						<hr class="dropdown-divider" />
					</li>
					<li>
						<a class="dropdown-item d-flex align-items-center" href="/user-profile">
							<i class="fa-solid fa-user"></i>
							<span>My Profile</span>
						</a>
					</li>
					<li>
						<hr class="dropdown-divider" />
					</li>
					<li>
						<a class="dropdown-item d-flex align-items-center" href="/logout">
							<i class="fa-solid fa-arrow-right-from-bracket"></i>
							<span>Sign Out</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</header>
<!-- /Header Navbar -->