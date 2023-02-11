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

	<!-- JQuery Confirm CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

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
							<form action="../../../controllers/DepartmentsController.php" method="POST" class="row g-3 needs-validation" novalidate>
								<!-- Department Name Input -->
								<div class="col-md-12">
									<div class="form-floating">
										<input type="text" class="form-control" id="floatingDeptName" name="dept-name" placeholder="Department Name" pattern="[A-Za-z\s]{3,}" title="Letters Only (atleast 3 characters)" required>
										<label for="floatingDeptName">Department Name</label>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Required (Atleast 3 characters)
										</div>
									</div>
								</div>
								<!-- Department Description Input -->
								<div class="col-12">
									<div class="form-floating">
										<textarea class="form-control" placeholder="Description" pattern="[A-Za-z0-9]+" title="Letters and Numbers Only" id="floatingDesc" name="dept-desc" style="height: 100px;" required></textarea>
										<label for="floatingDesc">Description</label>
										<div class="valid-feedback">
											Looks good!
										</div>
										<div class="invalid-feedback">
											Required
										</div>
									</div>
								</div>
								<!-- Department Status Select -->
								<div class="col-12">
									<div class="form-floating mb-3">
										<select class="form-select" id="floatingStatus" name="status" aria-label="State" required>
											<option value="Active">Active</option>
											<option value="Inactive" selected>Inactive</option>
										</select>
										<label for="floatingStatus">Status</label>
									</div>
								</div>
								<!-- Modal Footer -->
								<div class="modal-footer d-flex justify-content-right">
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
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Departments</h5>
							<?php
							if (isset($_SESSION['msg']) && isset($_SESSION['alert_type'])) {
								$msg = $_SESSION['msg'];
								$alert = $_SESSION['alert_type'];
								echo '<div id="msg" class="alert ' . $alert . ' alert-dismissible fade show" role="alert">'
									. $msg .
									"</div>";
								unset($_SESSION["msg"]);
							}

							?>
							<div class="table-responsive">
								<table id="departments-table" class="display w-100">
									<caption>List of Departments</caption>

									<thead>
										<tr>
											<th>Department Name</th>
											<th>Description</th>
											<th>Date Added</th>
											<th>Date Modified</th>
											<th>Status</th>
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
													<td><?= $dept_name; ?></td>
													<td><?= $dept_desc; ?></td>
													<td><?= $created_at; ?></td>
													<td><?= $updated_at; ?></td>
													<td>
														<?php
														if ($status == 'Active') {
															echo
															'<span class="badge rounded-pill text-bg-success">Active</span>';
														} else {
															echo '<span class="badge rounded-pill text-bg-danger">Inactive</span>';
														}
														?>
													</td>
													<td class="text-center d-grid gap-2">
														<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#updateModal">
															<i class="fa-solid fa-pen-to-square"></i>
														</button>

														<button class="btn btn-danger" id="deleteData" href="../../../controllers/DepartmentsController.php?action=Delete&id=<?= $id; ?>">
															<i class="fa-solid fa-trash-can"></i>
														</button>
														<!-- <a class="text-secondary" href="../../../controllers/DepartmentsController.php?action=Update&id=<?= $id; ?>"></i></a>
												<a class="text-danger" href="../../../controllers/DepartmentsController.php?action=Delete&id=<?= $id; ?>"></a> -->
													</td>
												</tr>
										<?php
											}
										} else {
											echo '<p class="text-danger text-center fw-bold"><em>No Records were found.</em></p>';
										}
										?>
									</tbody>
								</table>
							</div>
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

	<!-- JQuery Confirm CDN JS  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

	<!-- Main JS -->
	<script src="../../../assets/js/main.js"></script>

	<!-- DataTable JS -->
	<script src="../../../assets/js/datatables.js"></script>

	<!-- JQuery Confirm Main JS  -->
	<script src="../../../assets/js/jquery-confirm.js"></script>

	<!-- JQuery Confirm Main JS  -->
	<script src="../../../assets/js/validateForm.js"></script>
</body>

</html>