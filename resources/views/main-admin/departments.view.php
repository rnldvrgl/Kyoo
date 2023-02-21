<?php

if (!isset($_SESSION['sid']) || $_SESSION['sid'] !== session_id() || isset($_SESSION['authorized']) !== TRUE || $_SESSION['account_id'] === '') {
	redirect('/login');
}

use Core\App;

use Core\Database;

$db = App::resolve(Database::class);

?>
<!-- Header -->
<?php require(base_path('resources/views/includes/header.php')); ?>
<!-- /Header -->

<!-- Header Navbar -->
<?php require(base_path('resources/views/partials/__header.php')); ?>
<!-- /Header Navbar -->

<!-- Sidebar -->
<?php require(base_path('resources/views/partials/__sidebar.php')); ?>
<!-- /Sidebar -->

<!-- Main Content -->
<main id="main" class="main">
	<div class="d-sm-flex align-items-center justify-content-between">
		<!-- Content Title -->
		<div class="pagetitle">
			<h1>Departments</h1>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
					<li class="breadcrumb-item active">Departments</li>
				</ol>
			</nav>
		</div>
		<!-- /Content Title -->

		<!-- Add Button (Modal Toggle)-->
		<button type="button" class="btn btn-sm btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDept">
			<!-- Button Icon -->
			<i class="fa-solid fa-plus"></i>
			Add Department
		</button>
		<!-- /Add Button -->

		<!-- Add Modal -->
		<div class="modal fade" id="addDept" tabindex="-1">
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
						<form action="/departments" method="POST" class="row g-3 needs-validation" novalidate>

							<!-- CSRT Token -->
							<input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

							<!-- Department Name Input -->
							<div class="col-md-12">
								<div class="form-floating">
									<input type="text" class="form-control" id="floatingDeptName" name="dept-name" placeholder="Department Name" pattern="[A-Za-z\s]{3,}" title="Letters Only (atleast 3 characters)" required>
									<label for="floatingDeptName">Department Name</label>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Required (Letters Atleast 3 characters)
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

		<!-- Update modal -->
		<div class="modal fade" id="update-dept-modal" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="update-dept-modal">Update Department</h5>
						<!-- Modal Close Button -->
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="update-dept-form" action="/department/update" class="row g-3 needs-validation" data-remote="true" novalidate>

							<input type="hidden" name="_method" value="PATCH">
							<!-- Hidden ID -->
							<input type="hidden" name="id" id="id">
							<!-- CSRT Token -->
							<input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

							<!-- Department Name Input -->
							<div class="col-md-12">
								<div class="form-floating">
									<input type="text" class="form-control" id="dept-name" name="dept_name" placeholder="Department Name" pattern="[A-Za-z\s]{3,}" title="Letters Only (atleast 3 characters)" required>
									<label for="dept-name">Department Name</label>
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
									<textarea class="form-control" placeholder="Description" pattern="[A-Za-z0-9]+" title="Letters and Numbers Only" id="dept-desc" name="dept_desc" style="height: 100px;" required></textarea>
									<label for="dept-desc">Description</label>
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
									<select class="form-select" id="status" name="status" aria-label="State" required>
										<option value="Active">Active</option>
										<option value="Inactive" selected>Inactive</option>
									</select>
									<label for="status">Status</label>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<!-- <button type="button" class="btn btn-primary" id="update-dept">Update</button> -->
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /Update Modal -->
	</div>

	<!-- Content Section -->
	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Departments</h5>
						<!-- Alert Message -->
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
						<!-- /Alert Message -->
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
										<th>Actions</th>
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
													<?php if ($status == 'Active') : ?>
														<span class="badge rounded-pill text-bg-success">Active</span>
													<?php else : ?>
														<span class="badge rounded-pill text-bg-danger">Inactive</span>
													<?php endif; ?>
												</td>
												<td class="text-center d-grid gap-2">

													<!-- View -->
													<button class="btn btn-primary view-dept" data-id="<?= $id ?>">
														<i class="fa-solid fa-eye"></i>
													</button>

													<!-- Update -->
													<button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#update-dept-modal" data-id="<?= $id ?>">
														<i class="fa-solid fa-pen-to-square"></i>
													</button>

													<!-- Delete -->
													<form action="/departments" method="POST">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="id" value="<?= $id ?>">
														<button type="submit" class="btn btn-danger">
															<i class="fa-solid fa-trash-can"></i>
														</button>
													</form>
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

<!-- Footer Partial -->
<?php require(base_path('resources/views/partials/__footer.php')); ?>
<!-- /Footer -->

<!-- Footer -->
<?php require(base_path('resources/views/includes/footer.php')); ?>
<!-- /Footer -->