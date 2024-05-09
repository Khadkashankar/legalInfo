<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Legal Advisor</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="./assets/img/fav.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

			<!-- Navbar & Hero Start -->
			<div class="position-relative p-0">
						<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
							<a href="" class="navbar-brand p-0">
								<h1 class="text-primary m-0"><i class="fa fa-balance-scale me-3"></i>Legal Advisor</h1>
							</a>
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
								<span class="fa fa-bars"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarCollapse">
								<div class="navbar-nav ms-auto py-0 pe-4">
									<a href="" class="nav-item nav-link">My appointment</a>
								</div>
								<div class="d-flex align-items-center">
							<div class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<!-- name -->
								<?php
										if (isset($_SESSION['name'])) {
											echo "Hi, " . $_SESSION['name'];
										}
										?>
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="#">Profile</a></li>
									<li><a class="dropdown-item" href="#">Settings</a></li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="user-logout.php">Logout</a></li>
								</ul>
							</div>
                </div>
							</div>
						</nav>

						<div class="py-5 bg-dark hero-header mb-5">
							<div class="container my-5 py-5">
								<div class="row align-items-center g-5">
									<div class="col-lg-6 text-center text-lg-start">
									</div>
									<div class="col-lg-6 text-center text-lg-end overflow-hidden">
										<img class="img-fluid" src="./assets/img/justice.png" height="200px" width="200px">
									</div>
								</div>
							</div>
						</div>
			</div>

        <!-- Footer Start -->
      	<?php include('./footer.php'); ?>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/counterup/counterup.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>
