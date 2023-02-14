<?php

session_start();

require '../../../Core/functions.php';

if (isset($_SESSION['sid']) !== session_id() && isset($_SESSION['authorized']) !== TRUE) {
	redirect('../../auth/login.php');
}

use Core\Database;

// require connection to the database
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
					<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
					<li class="breadcrumb-item active">Accounts</li>
				</ol>
			</nav>
		</div>
		<!-- /Content Title -->

		<!-- Add Button (Modal Toggle)-->
		<button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addAccount">
			<!-- Button Icon -->
			<i class="fa-solid fa-plus"></i>
			Add Account
		</button>
		<!-- /Add Button -->

		<!-- Add Modal -->
		<div class="modal fade" id="addAccount" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<!-- Modal Title -->
						<h5 class="modal-title">
							Add Account
						</h5>
						<!-- Modal Close Button -->
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<!-- Modal Body -->
					<div class="modal-body">
						<!-- Form -->
						<form action="#" method="POST" class="row g-3 needs-validation" novalidate>

							<!-- Full Name Input -->
							<div class="col-md-12">
								<div class="form-floating">
									<input type="text" class="form-control" id="floatingName" name="full-name" placeholder="Full Name" pattern="[A-Za-z\s]{5,}" title="Full Name (First Name Last Name)" required>
									<label for="floatingName">Full Name (First Name Last Name)</label>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Please provide a valid name.
									</div>
								</div>
							</div>

							<!-- Department Description Input -->
							<div class="col-12">
								<div class="form-floating">
									<input type="email" class="form-control" id="floatingEmail" placeholder="Email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" required>
									<label for="floatingEmail" required>Email</label>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Please provide a valid email.
									</div>
								</div>
							</div>
							<!-- Department Select -->
							<div class="col-12">
								<div class="form-floating mb-3">
									<select class="form-select" id="floatingDept" name="department" aria-label="State" required>
										<option value="Registrar" selected>Registrar</option>
										<option value="Cashier">Cashier</option>
									</select>
									<label for="floatingDept">Department</label>
								</div>
							</div>

							<!-- Role Select -->
							<div class="col-12">
								<div class="form-floating mb-3">
									<select class="form-select" id="floatingRole" name="department" aria-label="State" required>
										<option value="2" selected>Department Admin</option>
										<option value="3">Staff</option>
									</select>
									<label for="floatingRole">Role</label>
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
										<th>Name</th>
										<th>Department</th>
										<th>Position</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Date Added</th>
										<th>Date Updated</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<td>Mark Lewence Endrano</td>
									<td>Registrar</td>
									<td>Department Admin</td>
									<td>mainadmin@gmail.com</td>
									<td>09123456789 </td>
									<td>#</td>
									<td>#</td>
									<td class="text-center d-grid gap-1">
										<button type="button" class="btn btn-secondary" id="viewData">
											<i class="fa-solid fa-eye"></i>
										</button>

										<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#updateModal">
											<i class="fa-solid fa-pen-to-square"></i>
										</button>

										<button class="btn btn-danger" id="deleteData" href="#">
											<i class="fa-solid fa-trash-can"></i>
										</button>
									</td>
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

<!-- Footer Partial -->
<?php require(base_path('pages/partials/__footer.php')); ?>
<!-- /Footer -->

<!-- Footer -->
<?php require(base_path('pages/includes/footer.php')); ?>
<!-- /Footer -->