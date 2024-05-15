<?php

session_start();

if (!isset($_SESSION['id'] ) ) {
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

			<?php
                if (!isset($_SESSION['name'])) {
                    include('header.php');
                } else {
                    include('logged-in-header.php');
                }
                ?>

				<div class="container">
				<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Here is your profile</h5>
            <h1 class="mb-5">My Profile</h1>

			<section>
			<div class="container">
				<div class="row">
					<?php
						include('./includes/connection.php');
								$query = "SELECT * FROM users WHERE user_id = {$_SESSION['id']}";
								$result = $conn->query($query);

								if ($result && $result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										?>
									<div class="col-md-9">
										<div class="mainprofile">
											<div class="row mb-3">
												<div class="col-md-4">
													<label for="name" class="fw-bold">Name:</label>
												</div>
												<div class="col-md-8">
													<p><?php echo $row["name"]; ?></p>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-md-4">
													<label for="email" class="fw-bold">Email:</label>
												</div>
												<div class="col-md-8">
													<p><?php echo $row["email"]; ?></p>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-md-4">
													<label for="contact" class="fw-bold">Contact:</label>
												</div>
												<div class="col-md-8">
													<p><?php echo $row["phone_number"]; ?></p>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-md-4">
													<label for="address" class="fw-bold">Address:</label>
												</div>
												<div class="col-md-8">
													<p><?php echo $row["address"]; ?></p>
												</div>
											</div>
											<div class="row mb-3">
												<div class="col-md-4">
													<label for="gender" class="fw-bold">Gender:</label>
												</div>
												<div class="col-md-8">
													<p><?php echo $row["gender"]; ?></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-end">
													
												</div>
											</div>
										</div>
									</div>
						<?php
						}
					}

					?>
				</div>
			</div>
</section>
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
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script>

</script>
    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>

</body>

</html>
