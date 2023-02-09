<?php

session_start();

require '../../../Core/functions.php';

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
<!doctype html>
<html lang="en">

<head>
	<title>Kyoo</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS and Custom SCSS -->
	<link rel="stylesheet" href="../../../dist/style.css">

	<!-- jQuery Framework CDN -->
	<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

	<!-- jQuery DataTables.net CSS-->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/98a2b5e7f0.js" crossorigin="anonymous"></script>


</head>

<body>
	<!-- Header Navbar -->
	<?php require('../../partials/__header.php'); ?>
	<!-- /Header Navbar -->

	<!-- Sidebar -->
	<?php require('../../partials/__sidebar.php'); ?>
	<!-- /Sidebar -->

	<!-- Main Content -->
	<main id="main" class="main">
		<div class="d-sm-flex align-items-center justify-content-between">
			<!-- Content Title -->
			<div class="pagetitle">
				<h1>Departments</h1>
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item active">Departments</li>
					</ol>
				</nav>
			</div>
			<!-- /Content Title -->

			<!-- Add Button (Modal Toggle)-->
			<button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAccount">
				<!-- Button Icon -->
				<i class="fa-solid fa-plus"></i>
				Add Department
			</button>
			<!-- /Add Button -->

			<!-- Add Modal -->
			<div class="modal fade" id="addAccount" tabindex="-1">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<!-- Modal Title -->
							<h5 class="modal-title">
								Add Department
							</h5>
							<!-- Modal Close Button -->
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<!-- Modal Body -->
						<div class="modal-body">
							<!-- Form -->
							<form action="../../../controllers/DepartmentsController.php" method="POST" class="row g-3">
								<!-- Department Name Input -->
								<div class="col-md-12">
									<div class="form-floating"> <input type="text" class="form-control" id="floatingDeptName" name="dept-name" placeholder="Department Name" pattern="[A-Za-z\s]+" title="Letters Only"> <label for="floatingDeptName">Department Name</label></div>
								</div>
								<!-- Department Description Input -->
								<div class="col-12">
									<div class="form-floating"><textarea class="form-control" placeholder="Description" pattern="[A-Za-z0-9]+" title="Letters and Numbers Only" id="floatingDesc" name="dept-desc" style="height: 100px;"></textarea><label for="floatingDesc">Description</label></div>
								</div>
								<!-- Department Status Select -->
								<div class="col-12">
									<div class="form-floating mb-3">
										<select class="form-select" id="floatingStatus" name="status" aria-label="State">
											<option value="Active">Active</option>
											<option value="Inactive" selected>Inactive</option>
										</select>
										<label for="floatingStatus">Status</label>
									</div>
								</div>

								<!-- Modal Footer -->
								<div class="modal-footer d-flex justify-content-between">
									<button class="btn text-danger" data-bs-dismiss="modal">
										Cancel
									</button>
									<button type="submit" name="add-dept" class="btn btn-success">
										Save
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Modal -->
		</div>

		<!-- Content Section -->
		<section class="section">
			<div class="row">
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Departments</h5>
							<?php
							if (isset($_SESSION['msg'])) {
								$msg = $_SESSION['msg'];
								echo "<p id='msg'>$msg</p>";
							}
							?>
							<table id="departments-table" class="display">
								<thead>
									<tr>
										<th>ID</th>
										<th>Department Name</th>
										<th>Description</th>
										<th>Status</th>
										<th>Date Added</th>
										<th>Date Modified</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// Get the Departments 
									$departments = $db->query('SELECT * FROM departments')->get();

									if (count($departments) > 0) {
										foreach ($departments as $department) {
											$id = $department['dept_id'];
											$dept_name = $department['dept_name'];
											$dept_desc = $department['dept_desc'];
											$status = $department['status'];
											$created_at = $department['created_at'];
											$updated_at = $department['updated_at'];
									?>
											<tr>
												<td><?= $id; ?></td>
												<td><?= $dept_name; ?></td>
												<td><?= $dept_desc; ?></td>
												<td><?= $status; ?></td>
												<td><?= $created_at; ?></td>
												<td><?= $updated_at; ?></td>
												<td>
													<a href="#">Update</a>
													<a href="#">Delete</a>
												</td>
											</tr>
									<?php
										}
									} else {
										echo "<p><em>No Records were found.</em></p>";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Example Card</h5>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, quos expedita dolore nesciunt commodi repellendus reprehenderit libero ipsum quia consequuntur vitae enim, voluptatem alias omnis rem iusto veritatis, ullam possimus.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Content Section -->

	</main>
	<!-- /Main Content -->

	<!-- Footer -->
	<?php require('../../partials/__footer.php'); ?>
	<!-- /Footer -->

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<!-- DataTable JS -->
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

	<!-- Main JS -->
	<script src="../../../assets/js/main.js"></script>

	<!-- DataTable JS -->
	<script src="../../../assets/js/datatables.js"></script>
</body>

</html>