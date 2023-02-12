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
// $config = require '../../config/connection.php';
$config = require base_path('config/connection.php');

require base_path('Core/Database.php');

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
	<div class="d-sm-flex align-items-center justify-content-between">
		<!-- Content Title -->
		<div class="pagetitle">
			<h1>Accounts</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Accounts</li>
				</ol>
			</nav>
		</div>
		<!-- /Content Title -->

		<!-- Add Button (Modal Toggle)-->
		<button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAccount">
			<!-- Button Icon -->
			<i class="fa-solid fa-plus"></i>
			Add Employee
		</button>
		<!-- /Add Button -->

		<!-- Add Modal -->
		<div class="modal fade" id="addAccount" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<!-- Modal Title -->
						<h5 class="modal-title">
							Add Employee
						</h5>
						<!-- Modal Close Button -->
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<!-- Modal Body -->
					<div class="modal-body">
						<!-- Form -->
						<form action="#" method="#" class="row g-3">
							<!-- Department Name Input -->
							<div class="col-md-12">
								<div class="form-floating"> <input type="text" class="form-control" id="floatingDeptName" placeholder="Department Name"> <label for="floatingDeptName">Department Name</label></div>
							</div>
							<!-- Department Description Input -->
							<div class="col-12">
								<div class="form-floating"><textarea class="form-control" placeholder="Description" id="floatingDesc" style="height: 100px;"></textarea><label for="floatingDesc">Description</label></div>
							</div>
							<!-- Department Status Select -->
							<div class="col-12">
								<div class="form-floating mb-3">
									<select class="form-select" id="floatingStatus" aria-label="State">
										<option value="active">Active</option>
										<option value="inactive" selected>Inactive</option>
									</select>
									<label for="floatingStatus">Status</label>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer d-flex justify-content-between">
						<button class="btn text-danger" data-bs-dismiss="modal">
							Cancel
						</button>
						<button type="submit" class="btn btn-success">
							Save
						</button>
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
						<h5 class="card-title">Accounts</h5>
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
								<caption>List of Accounts</caption>

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
									// Get all users 
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

<!-- Footer Partial -->
<?php require(base_path('pages/partials/__footer.php')); ?>
<!-- /Footer -->

<!-- Footer -->
<?php require(base_path('pages/includes/footer.php')); ?>
<!-- /Footer -->