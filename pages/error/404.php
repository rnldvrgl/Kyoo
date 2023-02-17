<?php

session_start();

require '../../Core/functions.php';

// TODO: Restrict access here if user just directly entered in the URL

if (isset($_SESSION['sid']) !== session_id() && isset($_SESSION['authorized']) !== TRUE) {
	redirect('/../Kyoo/pages/auth/login.php');
}

?>
<!-- Header -->
<?php require(base_path('pages/includes/header.php')); ?>
<!-- /Header -->

<!-- Main Content -->
<main>
	<div class="container">
		<section class="section error-404">
			<div class="row">
				<div class="col-md-7">
					<img src="<?php path('assets/img/error-404.png') ?>" class="img-fluid py-5" alt="Page Not Found">
				</div>
				<div class="col-md-5 d-flex flex-column justify-content-center align-items-right gap-3">
					<h1>Whooops!</h1>
					<h2>Sorry, the page you are looking for doesn't exist.</h2>
					<a class="btn rounded-pill btn-kyoored" href="javascript:history.go(-1)">Back to home</a>
				</div>
			</div>
		</section>
	</div>
</main>
<!-- /Main Content -->

<!-- Footer -->
<?php require(base_path('pages/includes/footer.php')); ?>
<!-- /Footer -->