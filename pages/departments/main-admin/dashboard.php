<?php

session_start();

require '../../../Core/functions.php';

// If session variable sid is not set OR sid is not equal to the current session id OR authorized session variable is false
if (!isset($_SESSION['sid']) || $_SESSION['sid'] !== session_id() || isset($_SESSION['authorized']) !== TRUE) {
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
									Number of Users in Queues
								</h5>

								<!-- Fetch the available years in the queue table -->
								<?php
								$years = $db->query("SELECT DISTINCT YEAR(created_at) as years FROM queue")->get();
								?>

								<!-- Display those years in a dropdown -->
								<select class="form-select" name="year" id="year" aria-label="State">
									<option value="" selected disabled>Select Year</option>
									<?php
									foreach ($years as $data) {
										$year = $data['years'];
									?>
										<option value="<?= $year ?>"><?= $year ?></option>
									<?php
									}
									?>
								</select>

								<!-- This is where the chart is displayed -->
								<canvas id="myChart"></canvas>
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

<!-- Script for the Chart -->
<script>
	$(document).ready(function() {

		const year = $('#year');

		// Get the canvas element
		var ctx = document.getElementById('myChart').getContext('2d');

		// Create the chart
		var myChart = null;

		year.on('change', function() {
			var selectedYear = $(this).val();

			// Make an AJAX request to the PHP script
			$.ajax({
				url: "../../../controllers/DashboardChartController.php",
				type: "POST",
				data: {
					year: selectedYear
				},
				success: function(data) {
					// Parse the JSON data
					var jsonData = JSON.parse(data);

					console.log(jsonData);

					// If a chart exists, destroy it
					if (myChart) {
						myChart.destroy();
					}

					// Then generate a new chart
					chart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
							datasets: [{
								label: 'Number of Users in Queue',
								data: jsonData,
								backgroundColor: 'rgba(54, 162, 235, 0.2)',
								borderColor: 'rgba(54, 162, 235, 1)',
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});

					// Save the new chart to the myChart variable
					myChart = chart;
				},
				error: function(xhr, status, error) {
					console.log("Error: " + error);
				}
			});
		})
	});
</script>

<!-- Footer Partial -->
<?php require(base_path('pages/partials/__footer.php')); ?>
<!-- /Footer -->

<!-- Footer -->
<?php require(base_path('pages/includes/footer.php')); ?>
<!-- /Footer -->