<!-- HTML Header -->
<?php require('includes/header.php') ?>
<!-- /HTML Header -->

<!-- Back to top button -->
<?php require('partials/__back-to-top.php') ?>
<!-- /Back to top button -->

<!-- Navbar -->
<nav id="scrollspy" class="navbar sticky-top navbar-expand-lg shadow bg-kyoodark navbar-dark">
	<!-- Container wrapper -->
	<div class="container px-5">

		<!-- Navbar brand -->
		<a class="navbar-brand" href="#">
			<img src="<?= base_path('public/images/kyoo-logo.svg') ?>" alt="" width=" 40" height="34">
		</a>

		<!-- Toggle Button -->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa-solid fa-bars"></i>
		</button>

		<!-- Collapsible wrapper -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav navbar-nav ms-auto me-4 my-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="#hero">
						<i class="fa-solid fa-house-chimney"></i>
						HOME
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#faqs">
						<i class="fa-solid fa-file-circle-question"></i>
						FAQs
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#feedback">
						<i class="fa-solid fa-message"></i>
						SEND FEEDBACK
					</a>
				</li>
			</ul>

			<div class="d-lg-inline-flex d-grid gap-3">
				<a class=" btn btn-outline-kyoored text-white rounded-pill px-3 mb-2 mb-lg-0" href="#">Live Queue</a>
				<?php if (isset($_SESSION['sid'])) : ?>
					<!-- Return to Dashboard -->
					<a class="btn btn-kyoored rounded-pill px-3 mb-2 mb-lg-0" href="pages/departments/main-admin/dashboard.php">Return Dashboard</a>
				<?php else : ?>
					<!-- Login -->
					<a class=" btn btn-kyoored rounded-pill px-3 mb-2 mb-lg-0" href="pages/auth/login.php">LOGIN</a>
				<?php endif; ?>
			</div>
		</div>
		<!-- Collapsible wrapper -->
	</div>
	<!-- Container wrapper -->
</nav>
<!-- Navbar -->

<!-- Hero Section -->
<section id="hero" class="d-flex justify-content-center align-items-center bg-kyoodark text-white pt-5 px-2 mb-0 overflow-hidden">
	<div class="container">
		<div class="row gx-5 align-items-center">
			<!-- Left Item -->
			<div class="col-lg-5">
				<div data-aos="fade-right" data-aos-duration="1000" class="d-flex align-items-center justify-content-center">
					<img class="img-fluid" src="<?= ROOT ?>/images/waiting-line.svg" alt="Waiting Line">
				</div>
			</div>
			<!-- Right Item -->
			<div class="col-lg-7">
				<div data-aos="fade-left" data-aos-duration="2000" class="text-center text-lg-start">
					<h1 class="display-5 fw-bold">Handle your queues wisely and instantaneously</h1>
					<p class="text-white-50">The Republic Central Colleges is committed to providing quality services to students, graduates, faculty, and other members of the school.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<img class="img-fluid" src="<?= ROOT ?>/images/wave.png" alt="">
<!-- /Hero Section -->

<!-- Frequently Asked Questions -->
<section id="faqs" class="container col-lg-8 p-5 section" style="margin-top: -50px;">
	<div class="d-flex flex-column justify-content-center align-items-center gap-3 p-5">
		<div data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="d-flex flex-column justify-content-center align-items-center gap-3 text-center mb-3">
			<h2 class="display-6 fw-bold">FAQs</h2>
			<p>Frequently Asked Questions</p>
		</div>
		<div class="accordion" id="accordionPanelsStayOpenExample">
			<div class="accordion-item">
				<h2 class="accordion-header" id="panelsStayOpen-headingOne">
					<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
						Accordion Item #1
					</button>
				</h2>
				<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
					<div class="accordion-body">
						<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="panelsStayOpen-headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
						Accordion Item #2
					</button>
				</h2>
				<div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
					<div class="accordion-body">
						<strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="panelsStayOpen-headingThree">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
						Accordion Item #3
					</button>
				</h2>
				<div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
					<div class="accordion-body">
						<strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
					</div>
				</div>
			</div>
		</div>
		<a href="#" class="btn btn-outline-kyoored">View More >></a>
	</div>
</section>
<!-- /Frequently Asked Questions -->

<!-- Send Feedback Section -->

<section id="feedback" class="bg-kyoodark border-bottom border-2 border-kyoored">
	<div class="container col-lg-12 p-5">
		<div class="d-flex flex-column justify-content-center align-items-center gap-3">
			<div data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="gap-3 text-center text-white mb-4">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<h2 class="display-6 fw-bold">SEND FEEDBACK</h2>
			</div>
			<div class="row">
				<div class="d-flex justify-content-center align-items-center gap-5">
					<div class="d-none d-lg-flex col-lg-5">
						<img class="img-fluid" src="<?= ROOT ?>/images/kyoo-logo.svg" alt="Kyoo Logo">
					</div>
					<div class="col-lg-7">
						<!-- Form -->
						<form action="#" method="POST" class="needs-validation d-flex flex-column gap-3" novalidate>
							<!-- Full Name Input -->
							<div class="col-lg-12">
								<div class="form-floating">
									<input type="text" class="form-control" id="floatingName" name="fullname" placeholder="Full Name" title="Enter Full Name">
									<label for="floatingName">Full Name (Optional)</label>
								</div>
							</div>
							<!-- Department Description Input -->
							<div class="col-lg-12">
								<div class="form-floating">
									<textarea class="form-control" placeholder="Description" id="floatingMessage" name="dept-desc" style="min-height: 100px; max-height: 200px;" required></textarea>
									<label for="floatingMessage">Feedback</label>
									<div class="valid-feedback">
										Looks good!
									</div>
									<div class="invalid-feedback">
										Required
									</div>
								</div>
							</div>

							<!-- Button Send -->
							<button type="submit" name="send-feedback" class="btn btn-kyoored">
								Send Feedback
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>
<!-- /Send Feedback Section -->

<!-- Landing Page Footer -->
<footer class="bg-kyoodark text-center py-5 shadow-lg">
	<div class="container px-5">
		<div class="text-white-50">
			<div class="copyright"> &copy; Kyoo | 2023. <strong>Optimus Byte</strong>. All Rights Reserved</div>
			<div class="credits">
				<a class="text-white" href="https://github.com/rnldvrgl" target="_blank">Ronald Vergel C. Dela Cruz</a>
				|
				<a class="text-white" href="https://github.com/HilthEXE" target="_blank">Mark Lewence Endrano</a>
			</div>
		</div>
	</div>
</footer>
<!-- /Landing Page Footer -->

<!-- HTML Footer -->
<?php require('includes/footer.php') ?>
<!-- /HTMLFooter -->