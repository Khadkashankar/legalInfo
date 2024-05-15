<?php
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="position-relative p-0">
						<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
							<a href="./user-dashboard.php" class="navbar-brand p-0">
								<h1 class="text-primary m-0"><i class="fa fa-balance-scale me-3"></i>Legal Advisor</h1>
							</a>
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
								<span class="fa fa-bars"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarCollapse">
								<div class="navbar-nav ms-auto py-0 pe-4">
									<a href="my-appointment.php"  class="nav-item nav-link userAppointment">My appointment</a>
								</div>
								<div class="d-flex align-items-center">
							<div class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php
										if (isset($_SESSION['name'])) {
											echo "Hi, " . $_SESSION['name'];
										}
										?>
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="user-profile.php">Profile</a></li>
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
										<img class="img-fluid" src="./assets/img/justice.png" height="150px" width="150px">
									</div>
								</div>
							</div>
						</div>
			</div>
