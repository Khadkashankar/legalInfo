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

		 <!-- About Start -->
		 <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s" src="">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s" src="" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s" src="">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s" src="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                        <!-- <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Legal </h1> -->
                        <p class="mb-4">Legal Advisor is revolutionizing legal services through its innovative online platform, offering
									accessible and user-friendly legal information and services.</p>
                        <p class="mb-4">It provides a comprehensive range
								of resources for individuals seeking guidance on personal or business-related legal matters.</p>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="about-us.php">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

		   <!-- Team Start -->
		<?php include('./show-lawyers.php'); ?>
        <!-- Team End -->
<br><br>

		<!--news-area start-->
		  	<div class="blog-area pd-top-115 pd-bottom-90">
				<div class="container p-sm-0">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="section-title text-center">
								<h2 class="title">LATEST NEWS</h2>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
							<?php
								$query = "SELECT * FROM news WHERE status = 'published'";
								$result = $conn->query($query);

								if ($result->num_rows > 0) {
									while ($news_row = $result->fetch_assoc()) {
							?>
							<div class="col-lg-4 col-md-6">
								<div class="single-blog-inner">
									<div class="thumb">
									<img src="./admin/newsimages/<?php echo $news_row['image']; ?>" alt="img" width="200px" height="150px">
									</div>
									<div class="details">
										<h4><a href="news-details.php?news_id=<?php echo $news_row['news_id']; ?>"><?php echo $news_row['title']; ?></a></h4>
										<a class="read-more-text" href="news-details.php?news_id=<?php echo $news_row['news_id']; ?>">READ MORE</a>
									</div>
								</div>
							</div>
							<?php
									}
								}
								else {
									echo "<p>No news available.</p>";
								}
							?>
					</div>
				</div>
   			</div>
			<br><br> <br>
    	<!-- news end-->

		<!-- articles start -->
		<div class="blog-area pd-top-115 pd-bottom-90">
				<div class="container p-sm-0">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="section-title text-center">
								<h2 class="title">LATEST ARTICLES</h2>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
							<?php
								$query = "SELECT * FROM articles WHERE status = 'published'";
								$result = $conn->query($query);

								if ($result->num_rows > 0) {
									while ($articles_row = $result->fetch_assoc()) {
							?>
							<div class="col-lg-4 col-md-6">
								<div class="single-blog-inner">
									<div class="thumb">
									<img src="./admin/articlesimages/<?php echo $articles_row['image']; ?>" alt="img" width="200px" height="150px">
									</div>
									<div class="details">
										<h4><a href="articles-details.php?article_id=<?php echo $articles_row['article_id']; ?>"><?php echo $articles_row['title']; ?></a></h4>
										<a class="read-more-text" href="articles-details.php?article_id=<?php echo $articles_row['article_id']; ?>">READ MORE</a>
									</div>
								</div>
							</div>
							<?php
									}
								}
								else {
									echo "<p>No articles available.</p>";
								}
							?>
					</div>
				</div>
   			</div>
   	    <!-- articles end-->

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
