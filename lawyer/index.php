<?php
session_start();
include('../includes/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM lawyers WHERE  email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $extra = "../lawyer/lawyer-dashboard.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        $extra = "index.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Lawyer Login</title>
	<link href="../admin/assets/css/style.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body class="bg-primary">
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">

								<div class="card-header">
									<h3 class="text-center font-weight-light my-4">Lawyer Login</h3>
								</div>
								<div class="card-body">

									<form method="post">

										<div class="form-floating mb-3">
											<input class="form-control" name="email" type="text" placeholder="email" required />
											<label for="inputEmail">Email</label>
										</div>


										<div class="form-floating mb-3 d-flex align-items-center">
											<input class="form-control" name="password" type="password" placeholder="Password" id="password" required />
											<label for="inputPassword">Password</label>
											<span class="m-4 position-absolute end-0">
												<i class="fas fa-eye" id="togglePassword" onclick="togglePasswordVisibility()"></i>
											</span>
										</div>


										<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
											<a class="small" href="../lawyer/lawyer-register.php">Register</a>
											<button class="btn btn-primary" name="login" type="submit">Login</button>
										</div>
									</form>
								</div>
								<div class="card-footer text-center py-3">
									<div class="small"><a href="../index.php">Back to Home Page</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="../admin/assets/js/script.js"></script>
	<script>
	 function togglePasswordVisibility() {
		 var x = document.getElementById("password");
		 var toggleIcon = document.getElementById("togglePassword");

		 if (x.type === "password") {
			x.type = "text";
			toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
		 } else {
			x.type = "password";
			toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
		}
	}
</script>
</body>

</html>
