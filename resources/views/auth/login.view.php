<!-- HTML Header -->
<?php require base_path('resources/views/includes/header.php') ?>
<!-- /HTML Header -->

<section class="vh-100">
	<div class="container h-100 w-75">
		<div class="row d-flex justify-content-center align-items-center h-100">

			<!-- Left Item -->
			<div class="d-none d-lg-flex flex-column justify-content-center align-items-center col-md-5 col-lg-6 text-center">
				<!-- Kyoo Logo -->
				<a href="/">
					<img class="img-fluid mb-3" src="images/kyoo-logo.svg" alt="Kyoo Logo">
				</a>
				<h4 class="fw-semibold text-uppercase">Queueing Management System</h4>
			</div>

			<!-- Right Item -->
			<div class="col-md-7 col-lg-6">
				<form class="d-flex flex-column justify-content-center align-items-center" method="POST" action="/login">
					<div class="text-center mb-3">
						<img class="mb-3" src="images/avatar.svg" alt="avatar icon">
						<h4 class="fw-semibold">WELCOME</h4>
					</div>
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

					<!-- CSRT Token -->
					<input type="hidden" name="csrf_token" value="<?= csrfToken() ?>">

					<!-- Input Email -->
					<div class="input-group mb-3">
						<span class="input-group-text">
							<i class="fa-solid fa-user fa-red" id="email-addon"></i>
						</span>
						<div class="form-floating">
							<input type="email" name="email" class="form-control" id="email" placeholder="Place email here" aria-label="email" aria-describedby="email-addon" autocomplete="off" required>
							<label for="email">Email</label>
						</div>
					</div>

					<!-- Input Password -->
					<div class="input-group mb-3">
						<span class="input-group-text">
							<i class="fa-solid fa-lock fa-red" id="password-addon"></i>
						</span>
						<div class="form-floating">
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" aria-label="password" aria-describedby="password-addon" required>
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

<!-- Footer -->
<?php require base_path('resources/views/includes/footer.php');
?>
<!-- /Footer -->