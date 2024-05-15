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
		 <section class="py-3 py-md-5">
  <div class="container">
    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
      <div class="col-12 col-lg-6 col-xl-5">
      </div>
      <div class="col-12 col-lg-6 col-xl-7">
        <div class="row justify-content-xl-center">
          <div class="col-12 col-xl-11">
            <h2 class="mb-3">Who Are We?</h2>
            <p class="mb-5">Recognizing the traditional barriers that often hinder individuals from accessing legal services, Legal Advisor has developed a platform that breaks down these barriers. Through the use of intuitive design and user-friendly interfaces, Legal Advisor ensures that navigating through legal information and services is effortless and understandable for everyone, regardless of their background or prior knowledge of the law.

Moreover, Legal Advisor offers a comprehensive range of resources to address various legal needs. Whether someone is looking to draft a will, establish a business entity, or seek advice on employment contracts, Legal Advisor provides a one-stop destination for all legal inquiries.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="mission-vision">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="card p-4">
                        <h3 class="card-title">Mission</h3>
                        <p class="card-text">
						Our mission is to revolutionize the legal services industry by providing accessible, user-friendly, and innovative solutions that empower individuals and businesses to navigate their legal matters with confidence and ease. We are committed to democratizing access to legal information and services, making them readily available to anyone, anywhere, at any time. Through our platform, we aim to simplify complex legal processes, enhance transparency, and ultimately improve the overall experience of engaging with the legal system.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card p-4">
                        <h3 class="card-title">Vision</h3>
                        <p class="card-text">
						Our vision is to become the leading online destination for legal information and services, recognized for our commitment to accessibility, innovation, and excellence. We envision a future where individuals and businesses can seamlessly access the legal resources they need, whether it's drafting a contract, resolving a dispute, or seeking expert advice, all from the comfort of their own homes. By leveraging technology and expertise, we aspire to transform the way people engage with the law, making legal services more efficient, affordable, and empowering for everyone.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <div class="card p-4">
                        <h3 class="card-title">Core Values</h3>
                        <ul>
                            <li>Accessibility: We believe in breaking down barriers to legal services, ensuring that everyone has access to the information.</li>
                            <li>Collaboration: We foster a culture of collaboration and teamwork, working closely with our users, legal experts, and partners.</li>
							<li>Innovation: We are committed to driving innovation in the legal industry, leveraging technology to create user-friendly solutions that enhance the delivery of legal services</li>
						</ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- About End -->

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
