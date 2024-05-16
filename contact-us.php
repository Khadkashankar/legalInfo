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
					<div class="contact-area mg-top-120 mb-120">
						<div class="row g-0 justify-content-center">
							<div class="col-lg-7">
								<form class="contact-form text-center">
									<h3>GET IN TOUCH</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="mb-3">
												<input type="text" id="username" class="form-control" placeholder="Your name" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="mb-3">
												<input type="email" id="useremail" class="form-control" placeholder="Your email" required>
											</div>
										</div>
										<div class="col-12">
											<div class="mb-3">
												<textarea class="form-control" id="usermessage" rows="5" placeholder="Write message" required></textarea>
											</div>
										</div>
										<div class="col-12">
											<button type="submit" class="btn btn-primary" id="send-message">SEND MESSAGE</button>
										</div>
									</div>
								</form>
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

	<script>
		$(document).ready(function() {
			$('#send-message').on('click', function(e) {
				e.preventDefault();

				var name = $('#username').val();
				var email = $('#useremail').val();
				var message = $('#usermessage').val();

				if (name === '' || email === '' || message === '') {
					Swal.fire({
						title: 'Error!',
						text: 'Please fill in all fields.',
						icon: 'error',
						confirmButtonText: 'OK'
					});
					return;
				}

				$.ajax({
					type: 'POST',
					url: 'send-email.php',
					data: {
						name: name,
						email: email,
						message: message
					},
					success: function(response) {
						console.log(response);
						if (response === 'success') {
							Swal.fire({
								title: 'Success!',
								text: 'Your message has been sent successfully.',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then(function() {
								window.location.reload();
							});
						} else {
							Swal.fire({
								title: 'Error!',
								text: 'Failed to send message. Please try again later.',
								icon: 'error',
								confirmButtonText: 'OK'
							});
						}
					},
					error: function(xhr, status, error) {
						console.log(error);
						Swal.fire({
							title: 'Error!',
							text: 'Failed to send message. Please try again later.',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				});
			});
		});
	</script>


</script>
    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>

</body>

</html>
