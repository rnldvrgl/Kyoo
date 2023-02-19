<?php

// // Database Namespace
// use Core\Database;

// // Database Class
// require base_path('Core/Database.php');

// // require connection to the database
// $config = require base_path('config/connection.php');

// // instantiate the database
// $db = new Database($config['database']);

// // Conditional statement
// if (isset($_SESSION['sid'])) {

// 	// Arrays of user information
// 	$account_id = $_SESSION['account_id'];

// 	$info = $db->query("SELECT * FROM accounts WHERE account_id = :account_id", [
// 		'account_id' => $account_id,
// 	])->get();

// 	// Loop through accounts table and get IDs
// 	foreach ($info as $ids) {
// 		$account_id = $ids['account_id'];
// 		$role_id = $ids['role_id'];
// 		$dept_id = $ids['dept_id'];
// 	}

// 	if (isset($account_id)) {
// 		if ($dept_id == 1) {
// 			// Department = Office
// 			if ($role_id == 1) {
// 				// Role = Main Admin
// 				redirect('../departments/main-admin/dashboard.php');
// 			}
// 		} else if ($dept_id == 2) {
// 			// Department = Registrar
// 			if ($role_id == 2) {
// 				// Role = Department Admin
// 				redirect('../departments/department-admin/dashboard.php');
// 			} else if ($role_id == 3) {
// 				// Role = Department Staff
// 				redirect('../departments/department-staff/dashboard.php');
// 			}
// 		} else if ($dept_id == 3) {
// 			// Department = Cashier
// 			if ($role_id == 2) {
// 				// Role = Department Admin
// 				redirect('../departments/department-admin/dashboard.php');
// 			} else if ($role_id == 3) {
// 				// Role = Department Staff
// 				redirect('../departments/department-staff/dashboard.php');
// 			}
// 		} else if ($dept_id == 4) {
// 			// Department = Library
// 			if ($role_id == 4) {
// 				// Role = Librarian
// 				redirect('../departments/library/dashboard.php');
// 			}
// 		}
// 	}
// }
?>

<!-- HTML Header -->
<?php require base_path('resources/views/includes/header.php') ?>
<!-- /HTML Header -->

<section class="vh-100">
	<div class="container h-100 w-75">
		<div class="row d-flex justify-content-center align-items-center h-100">

			<!-- Left Item -->
			<div class="d-none d-lg-flex flex-column justify-content-center align-items-center col-md-5 col-lg-6 text-center">
				<!-- Kyoo Logo -->
				<a href="/">
					<img class="img-fluid mb-3" src="images/kyoo-logo.svg" alt="Kyoo Logo">
				</a>
				<h4 class="fw-semibold text-uppercase">Queueing Management System</h4>
			</div>

			<!-- Right Item -->
			<div class="col-md-7 col-lg-6">
				<form class="d-flex flex-column justify-content-center align-items-center" method="POST" action="/login">
					<div class="text-center mb-3">
						<img class="mb-3" src="images/avatar.svg" alt="avatar icon">
						<h4 class="fw-semibold">WELCOME</h4>
					</div>
					<!-- Error Message -->
					<?php if (isset($_SESSION['err'])) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $_SESSION['err']; ?>
						</div>
					<?php
					endif;

					// Unset after Display
					unset($_SESSION['err']);
					?>
					<!-- /Error Message -->

					<!-- Input Email -->
					<div class="input-group mb-3">
						<span class="input-group-text">
							<i class="fa-solid fa-user fa-red" id="email-addon"></i>
						</span>
						<div class="form-floating">
							<input type="email" name="email" class="form-control" id="email" placeholder="Place email here" aria-label="email" aria-describedby="email-addon" autocomplete="off" required>
							<label for="email">Email</label>
						</div>
					</div>

					<!-- Input Password -->
					<div class="input-group mb-3">
						<span class="input-group-text">
							<i class="fa-solid fa-lock fa-red" id="password-addon"></i>
						</span>
						<div class="form-floating">
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" aria-label="password" aria-describedby="password-addon" required>
							<label for="password">Password</label>
						</div>
					</div>

					<!-- Sign in button -->
					<div class="d-grid gap-2 col-6 mx-auto">
						<button type="submit" class="btn btn-block btn-kyoored">SIGN IN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Footer -->
<?php require base_path('resources/views/includes/footer.php');
?>
<!-- /Footer -->