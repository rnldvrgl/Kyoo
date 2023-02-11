<?php

session_start();

require '../../Core/functions.php';

if (isset($_SESSION['sid']) !== session_id() && isset($_SESSION['authorized']) !== TRUE) {
	redirect('../../auth/login.php');
}

// Uncomment to check if user's information are saved into the session
// dd($_SESSION['user_info']);

use Core\Database;

// require connection to the database
$config = require '../../config/connection.php';

require '../../Core/Database.php';

// instantiate the Database
$db = new Database($config['database']);

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

	<!-- jQuery Framework CDN -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

	<!-- jQuery DataTables.net CSS-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/98a2b5e7f0.js" crossorigin="anonymous"></script>

</head>

<body>
	<!-- Header Navbar -->
	<?php require('../partials/__header.php'); ?>
	<!-- /Header Navbar -->

	<!-- Sidebar -->
	<?php require('../partials/__sidebar.php'); ?>
	<!-- /Sidebar -->

	<!-- Main Content -->
	<main id="main" class="main">
		<div class="pagetitle">
			<h1>Profile</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="/../Kyoo/pages/departments/main-admin/dashboard.php">Home</a>
					</li>
					<li class="breadcrumb-item active">User Profile</li>
				</ol>
			</nav>
		</div>
		<section class="section profile">
			<div class="row">
				<div class="col-xl-4">
					<div class="card">
						<div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
							<img src="../../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" />
							<h2><?= $name ?></h2>
							<h3><?= $role ?></h3>
						</div>
					</div>
				</div>
				<div class="col-xl-8">
					<div class="card">
						<div class="card-body pt-3">
							<ul class="nav nav-tabs nav-tabs-bordered">
								<li class="nav-item">
									<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">
										Overview
									</button>
								</li>
								<li class="nav-item">
									<button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">
										Edit Profile
									</button>
								</li>
								<li class="nav-item">
									<button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
										Change Password
									</button>
								</li>
							</ul>
							<div class="tab-content pt-2">

								<?php
								// TODO: Paki-ayos nalang pwesto neto Boss Salamat! hahahahahha tapos di rin sya nawawala kung di rerefresh

								if (isset($_SESSION['profile_msg']) && isset($_SESSION['alert_type'])) {
									$msg = $_SESSION['profile_msg'];
									$alert = $_SESSION['alert_type'];
									echo '<div id="msg" class="alert ' . $alert . ' alert-dismissible fade show" role="alert">'
										. $msg .
										"</div>";
									unset($_SESSION["profile_msg"]);
								}
								?>

								<!-- Overview -->
								<div class="tab-pane fade show active profile-overview" id="profile-overview">
									<h5 class="card-title">About</h5>
									<p class="small fst-italic">
										<?= $about; ?>
									</p>
									<h5 class="card-title">
										Profile Details
									</h5>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Full Name
										</div>
										<div class="col-lg-9 col-md-8">
											<?= $name; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Department
										</div>
										<div class="col-lg-9 col-md-8">
											<?= $dept_name; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Position
										</div>
										<div class="col-lg-9 col-md-8">
											<?= $role; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Address
										</div>
										<div class="col-lg-9 col-md-8">
											<?= $address; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Phone
										</div>
										<div class="col-lg-9 col-md-8">
											<?= $phone; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-md-4 label">
											Email
										</div>
										<div class="col-lg-9 col-md-8">
											<?= $email; ?>
										</div>
									</div>
								</div>

								<!-- Edit Profile -->
								<div class="tab-pane fade profile-edit pt-3" id="profile-edit">
									<!-- Form -->
									<form action="/../Kyoo/controllers/UserProfileController.php" method="POST">
										<div class="row mb-3">
											<label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
											<div class="col-md-8 col-lg-9">
												<img src="../../assets/img/profile-img.jpg" alt="Profile" />
												<div class="pt-2">
													<a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="fa-solid fa-upload"></i></a>
													<a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="fa-solid fa-trash-can"></i></a>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-8 col-lg-9">
												<input name="user_id" type="hidden" class="form-control" id="user_id" value="<?= $user_id; ?>" />
											</div>
										</div>

										<div class="row mb-3">
											<label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
											<div class="col-md-8 col-lg-9">
												<input name="name" type="text" class="form-control" id="name" value="<?= $name; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
											<div class="col-md-8 col-lg-9">
												<textarea name="about" class="form-control" id="about" style="height: 75px"><?= $about; ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<label for="department" class="col-md-4 col-lg-3 col-form-label">Department</label>
											<div class="col-md-8 col-lg-9">
												<input name="department" type="text" class="form-control" id="department" value="<?= $dept_name; ?>" disabled />
											</div>
										</div>
										<div class="row mb-3">
											<label for="position" class="col-md-4 col-lg-3 col-form-label">Position</label>
											<div class="col-md-8 col-lg-9">
												<input name="position" type="text" class="form-control" id="position" value="<?= $role; ?>" disabled />
											</div>
										</div>
										<div class="row mb-3">
											<label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
											<div class="col-md-8 col-lg-9">
												<input name="address" type="text" class="form-control" id="Address" value="<?= $address; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
											<div class="col-md-8 col-lg-9">
												<input name="phone" type="text" class="form-control" id="Phone" value="<?= $phone; ?>" />
											</div>
										</div>
										<div class="row mb-3">
											<label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
											<div class="col-md-8 col-lg-9">
												<input name="email" type="email" class="form-control" id="Email" value="<?= $email; ?>" disabled />
											</div>
										</div>
										<div class="text-center">
											<button type="submit" name="save-changes" class="btn btn-success">
												Save Changes
											</button>
										</div>
									</form>
								</div>

								<!-- Change Password -->
								<div class="tab-pane fade pt-3" id="profile-change-password">
									<form action="/../Kyoo/controllers/UserProfileController.php" method="POST">

										<div class="row">
											<div class="col-md-8 col-lg-9">
												<input name="user_id" type="hidden" class="form-control" id="user_id" value="<?= $user_id; ?>" />
											</div>
										</div>

										<div class="row mb-3">
											<label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
											<div class="col-md-8 col-lg-9">
												<input name="password" type="password" class="form-control" id="currentPassword" />
											</div>
										</div>
										<div class="row mb-3">
											<label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
											<div class="col-md-8 col-lg-9">
												<input name="newpassword" type="password" class="form-control" id="newPassword" />
											</div>
										</div>
										<div class="row mb-3">
											<label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
												Password</label>
											<div class="col-md-8 col-lg-9">
												<input name="renewpassword" type="password" class="form-control" id="renewPassword" />
											</div>
										</div>
										<div class="text-center">
											<button type="submit" name="change-password" class="btn btn-success">
												Change Password
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<!-- /Main Content -->

	<!-- Footer -->
	<?php require('../partials/__footer.php'); ?>
	<!-- /Footer -->

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<!-- DataTable JS -->
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

	<!-- Main JS -->
	<script src="../../assets/js/main.js"></script>
</body>

</html>