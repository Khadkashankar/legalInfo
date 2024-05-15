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

			<div class="blog-details-area pd-top-120 pd-bottom-120">
					<div class="container">
						<div class="row justify-content-center">
							<?php
							include('./includes/connection.php');
							if(isset($_GET['news_id']) && is_numeric($_GET['news_id'])) {
								$news_id = $_GET['news_id'];
								$query = "SELECT * FROM news WHERE news_id = $news_id";
								$result = $conn->query($query);

								if ($result && $result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										?>
							<div class="col-lg-8">
								<div class="single-blog-inner style-2">
									<div class="thumb">
										<img src="./admin/newsimages/<?php echo $row['image']; ?>" alt="img" width="450px" height="400px">
									</div>
									<div class="details">
										<h2><a href="#"><?php echo $row['title']; ?></a></h2>
										<p><?php echo $row['description']; ?></p>
									</div>
								</div>
							</div>
							<?php
									}
								}
							}
								?>
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
