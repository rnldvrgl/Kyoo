<?php

session_start();

require '../../../Core/functions.php';

// Arrays of the user's information
$info = $_SESSION['user_info'];

if (isset($_SESSION['sid']) !== session_id() && isset($_SESSION['authorized']) !== TRUE) {
	redirect('../../auth/login.php');
}

// Uncomment to check if user's information are saved into the session
// dd($_SESSION['user_info']);

use Core\Database;

// require connection to the database
$config = require '../../../config/connection.php';

require '../../../Core/Database.php';

// instantiate the Database
$db = new Database($config['database']);

?>
<!-- Header -->
<?php require(base_path('pages/includes/header.php')); ?>
<!-- /Header -->

<!-- Header Navbar -->
<?php require(base_path('pages/partials/__header.php')); ?>
<!-- /Header Navbar -->

<!-- Sidebar -->
<?php require(base_path('pages/partials/__sidebar.php')); ?>
<!-- /Sidebar -->

<!-- Main Content -->
<main id="main" class="main">
	<div class="pagetitle">
		<h1>Dashboard</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="dashboard.php">Home</a>
				</li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</nav>
	</div>
	<section class="section dashboard">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-xxl-4 col-md-6">
						<div class="card info-card sales-card">
							<div class="card-body">
								<h5 class="card-title">
									Sample
								</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
									</div>
									<div class="ps-3">
										<h6>0</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xxl-4 col-md-6">
						<div class="card info-card revenue-card">
							<div class="card-body">
								<h5 class="card-title">
									Sample</span>
								</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-currency-dollar"></i>
									</div>
									<div class="ps-3">
										<h6>0</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xxl-4 col-xl-12">
						<div class="card info-card customers-card">
							<div class="card-body">
								<h5 class="card-title">
									Sample
								</h5>
								<div class="d-flex align-items-center">
									<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-people"></i>
									</div>
									<div class="ps-3">
										<h6>0</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">
									Sample
								</h5>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card overflow-auto">
							<div class="card-body">
								<h5 class="card-title">
									Sample
								</h5>
								<table class="table table-borderless datatable">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">
												1
											</th>
											<th scope="col">Col</th>
											<th scope="col">Col</th>
											<th scope="col">Col</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">
												0
											</th>
											<td>
												1

											</td>
											<td>
												2
											</td>
											<td>
												3

											</td>
											<td>
												4
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card overflow-auto">
							<div class="card-body pb-0">
								<h5 class="card-title">
									Sample
								</h5>
								<table class="table table-borderless">
									<thead>
										<tr>
											<th scope="col">Col</th>
											<th scope="col">Col</th>
											<th scope="col">Col</th>
											<th scope="col">Col</th>
											<th scope="col">Col</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th scope="row">
												0
											</th>
											<td>
												1
											</td>
											<td>
												2
											</td>
											<td>
												3
											</td>
											<td>
												4
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">
							Sample
						</h5>
					</div>
				</div>
				<div class="card">
					<div class="card-body pb-0">
						<h5 class="card-title">
							Sample
						</h5>
					</div>
				</div>
				<div class="card">
					<div class="card-body pb-0">
						<h5 class="card-title">
							Sample
						</h5>
					</div>
				</div>
				<div class="card">
					<div class="card-body pb-0">
						<h5 class="card-title">
							Sample
						</h5>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<!-- /Main Content -->

<!-- Footer Partial -->
<?php require(base_path('pages/partials/__footer.php')); ?>
<!-- /Footer -->

<!-- Footer -->
<?php require(base_path('pages/includes/footer.php')); ?>
<!-- /Footer -->