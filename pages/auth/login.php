<?php
session_start();

require '../../Core/functions.php';

// Conditional statement
if (isset($_SESSION['sid'])) {

	// Arrays of user information
	$info = $_SESSION['user_info'];

	// Loop through accounts table and get IDs
	foreach ($info['accounts'] as $ids) {
		$account_id = $ids['account_id'];
		$role_id = $ids['role_id'];
		$dept_id = $ids['dept_id'];
	}

	if (isset($account_id)) {
		if ($dept_id == 1) {
			// Department = Office
			if ($role_id == 1) {
				// Role = Main Admin
				redirect('../departments/main-admin/dashboard.php');
			}
		} else if ($dept_id == 2) {
			// Department = Registrar
			if ($role_id == 2) {
				// Role = Department Admin
				redirect('../departments/department-admin/dashboard.php');
			} else if ($role_id == 3) {
				// Role = Department Staff
				redirect('../departments/department-staff/dashboard.php');
			}
		} else if ($dept_id == 3) {
			// Department = Cashier
			if ($role_id == 2) {
				// Role = Department Admin
				redirect('../departments/department-admin/dashboard.php');
			} else if ($role_id == 3) {
				// Role = Department Staff
				redirect('../departments/department-staff/dashboard.php');
			}
		} else if ($dept_id == 4) {
			// Department = Library
			if ($role_id == 4) {
				// Role = Librarian
				redirect('../departments/library/dashboard.php');
			}
		}
	}
}
?>
<!doctype html>
<html lang="en">

<head>
	<title>Kyoo</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS and Custom SCSS -->
	<link rel="stylesheet" href="../../dist/style.css">

	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/98a2b5e7f0.js" crossorigin="anonymous"></script>

</head>

<body>
	<section class="vh-100">
		<div class="container h-100 w-75">
			<div class="row d-flex justify-content-center align-items-center h-100">

				<!-- Left Item -->
				<div class="d-none d-lg-flex flex-column justify-content-center align-items-center col-md-5 col-lg-6 text-center">
					<!-- Kyoo Logo -->
					<a href="../../index.php">
						<img class="img-fluid mb-3" src="../../assets/img/kyoo-logo.svg" alt="Kyoo Logo">
					</a>
					<h4 class="fw-semibold text-uppercase">Queueing Management System</h4>
				</div>

				<!-- Right Item -->
				<div class="col-md-7 col-lg-6">
					<form class="d-flex flex-column justify-content-center align-items-center" method="POST" action="../../Core/login.php">
						<div class="text-center mb-3">
							<img class="mb-3" src="../../assets/img/avatar.svg" alt="avatar icon">
							<h4 class="fw-semibold">WELCOME</h4>
						</div>
						<!-- Input Email -->
						<?php
						if (isset($_SESSION['err'])) {
							$err = $_SESSION['err'];
							echo "<p>$err</p>";
						}
						?>
						<div class="input-group mb-3">
							<span class="input-group-text">
								<i class="fa-solid fa-user fa-red" id="email-addon"></i>
							</span>
							<div class="form-floating">
								<input type="email" name="email" class="form-control" id="email" placeholder="Place email here" aria-label="email" aria-describedby="email-addon" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>" required>
								<label for="email">Email</label>
							</div>
						</div>
						<!-- Input Password -->
						<div class="input-group mb-3">
							<span class="input-group-text">
								<i class="fa-solid fa-lock fa-red" id="password-addon"></i>
							</span>
							<div class="form-floating">
								<input type="password" name="password" class="form-control" id="password" placeholder="Password" aria-label="password" aria-describedby="password-addon" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>" required>
								<label for="password">Password</label>
							</div>
						</div>

						<!-- Sign in button -->
						<div class="d-grid gap-2 col-6 mx-auto">
							<button type="submit" name="submit" class="btn btn-block btn-kyoored">SIGN IN</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

<!-- Form Validate -->
<!-- <script src="../../assets/js/validateForm.js"></script> -->

</html>