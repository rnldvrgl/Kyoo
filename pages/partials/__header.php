<?php
// Fetched all arrays inside user_info array
$accounts = $_SESSION['user_info']['accounts'];
$account_details = $_SESSION['user_info']['account_details'];
$account_login = $_SESSION['user_info']['account_login'];
$account_roles = $_SESSION['user_info']['account_role'];
$departments = $_SESSION['user_info']['department'];

// Loop to get the data inside accounts table
foreach ($accounts as $a) {
	$account_id = $a['account_id'];
	$role_id = $a['role_id'];
	$user_id = $a['user_id'];
	$login_id = $a['login_id'];
	$dept_id = $a['dept_id'];
}

// Loop to get the data inside accounts_details table
foreach ($account_details as $ad) {
	$user_id = $ad['user_id'];
	$name = $ad['name'];
	$address = $ad['address'];
	$phone = $ad['phone'];
	$about = $ad['about'];
}

// Loop to get the data inside accounts_login table
foreach ($account_login as $al) {
	$login_id = $al['login_id'];
	$email = $al['email'];
}

// Loop to get the data inside accounts_login table
foreach ($account_roles as $ar) {
	$role_id = $ar['role_id'];
	$role = $ar['role_name'];
}

// Loop to get the data inside departments table
foreach ($departments as $d) {
	$dept_id = $d['dept_id'];
	$dept_name = $d['dept_name'];
	$status = $d['status'];
}
?>

<!-- Header Navbar -->
<header id="header" class="header fixed-top d-flex align-items-center bg-kyoodark">
	<div class="d-flex align-items-center justify-content-between">
		<a href="#" class="logo d-flex align-items-center">
			<img src="/../Kyoo/assets/img/kyoo-logo.png" alt="" />
			<span class="d-none d-lg-block">Queueing Management System</span>
		</a>
		<i class="fa-solid fa-bars toggle-sidebar-btn"></i>
	</div>
	<nav class="header-nav ms-auto">
		<ul class="d-flex align-items-center">
			<li class="nav-item d-none d-md-block datetime pe-3 text-center">
				<h6 class="day mb-0">Thursday</h6>
				<span class="date">February 09, 2023</span>
			</li>
			<li class=" nav-item dropdown pe-3">
				<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
					<img src="/../Kyoo/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" />
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
						<a class="dropdown-item d-flex align-items-center" href="/../Kyoo/pages/departments/user-profile.php">
							<i class="fa-solid fa-user"></i>
							<span>My Profile</span>
						</a>
					</li>
					<li>
						<hr class="dropdown-divider" />
					</li>
					<li>
						<a class="dropdown-item d-flex align-items-center" href="../../../Core/logout.php">
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