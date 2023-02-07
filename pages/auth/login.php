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
					<form class="d-flex flex-column justify-content-center align-items-center" method="get" action="../departments/main-admin/dashboard.php">
						<div class="text-center mb-3">
							<img class="mb-3" src="../../assets/img/avatar.svg" alt="avatar icon">
							<h4 class="fw-semibold">WELCOME</h4>
						</div>
						<!-- Input Email -->
						<div class="input-group mb-3">
							<span class="input-group-text">
								<i class="fa-solid fa-user fa-red" id="email-addon"></i>
							</span>
							<div class="form-floating">
								<input type="email" class="form-control" id="email" placeholder="Place email here" aria-label="email" aria-describedby="email-addon" required>
								<label for="email">Email</label>
							</div>
						</div>
						<!-- Input Password -->
						<div class="input-group mb-3">
							<span class="input-group-text">
								<i class="fa-solid fa-lock fa-red" id="password-addon"></i>
							</span>
							<div class="form-floating">
								<input type="password" class="form-control" id="password" placeholder="Password" aria-label="password" aria-describedby="password-addon" required>
								<label for="password">Password</label>
							</div>
						</div>

						<!-- Sign in button -->
						<div class="d-grid gap-2 col-6 mx-auto">
							<button type="submit" class="btn btn-block btn-kyoored">SIGN IN</button>
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