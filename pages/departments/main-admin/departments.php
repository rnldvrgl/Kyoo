<!doctype html>
<html lang="en">

<head>
	<title>Kyoo</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS and Custom SCSS -->
	<link rel="stylesheet" href="../../../dist/style.css">

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
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
							<h5 class="card-title">Example Card</h5>
							<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vel ex error magnam earum quia? Aut distinctio autem quis ullam magnam modi amet repellat, enim quasi esse, non totam ipsa quo.</p>
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

	<script src="../../../assets/js/main.js"></script>
	</script>
</body>

</html>