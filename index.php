<!doctype html>
<html lang="en">

<head>
	<title>Kyoo</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->

	<!-- Custom SCSS -->
	<link rel="stylesheet" href="dist/style.css">

	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/98a2b5e7f0.js" crossorigin="anonymous"></script>

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>

	<!-- Landing Page Navigation Bar -->
	<nav class="navbar navbar-dark navbar-expand-lg navbar-scroll fixed-top border-bottom bg-kyoodark">
		<div class="d-flex container justify-content-between">
			<!-- Left Elements -->
			<div class="d-flex my-2 my-sm-0">
				<!-- Brand -->
				<a class="navbar-brand" href="#">
					<img src="assets/img/kyoo-logo.svg" alt="" style="width: 3rem;">
				</a>
			</div>
			<!-- Toggler -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Center Elements -->
			<div class="collapse navbar-collapse d-flex container justify-content-between" id="navbarSupportedContent">
				<ul class="navbar-nav flex-row d-none d-md-flex">
					<li class="nav-item me-3 me-lg-1">
						<a class="nav-link active" aria-current="page" href="#">
							<span>
								<i class="bi bi-house"></i>
							</span>
							HOME
						</a>
					</li>
					<li class="nav-item me-3 me-lg-1">
						<a class="nav-link" href="#">
							<span>
								<i class="bi bi-house"></i>
							</span>
							FAQs
						</a>
					</li>
					<li class="nav-item me-3 me-lg-1">
						<a class="nav-link" href="#">
							<span>
								<i class="bi bi-envelope-check-fill"></i>
							</span>
							SEND FEEDBACK
						</a>
					</li>
				</ul>

				<!-- Right Elements -->
				<ul class="navbar-nav flex-row d-none d-md-flex">
					<li class="nav-item me-3 me-lg-1">
						<a class="btn btn-kyoored" href="pages/auth/login.php">
							LOGIN
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<li class="nav-item me-3 me-lg-1">
		<a class="btn btn-outline-kyoored " href="#!">
			VIEW QUEUE
		</a>
	</li>

	<div class="d-flex align-items-center justify-content-center text-center" style="height: 2000px;">
		<p class="h3">Scroll down to see the effect of change the navbar background-color</p>
	</div>

	<?php include('pages/includes/footer.php') ?>