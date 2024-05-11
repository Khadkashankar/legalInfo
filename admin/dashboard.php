<?php
session_start();

if (! isset($_SESSION['login'])) {
    header("Location: ../admin/index.php");
    exit();
}
include('../includes/connection.php');

function countTotalUsers($conn) {
    $sql = "SELECT COUNT(*) AS totalUsers FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalUsers'];
}

function countTotalAppointments($conn) {
    $sql = "SELECT COUNT(*) AS totalAppointments FROM appointments";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalAppointments'];
}

function countTotalArticles($conn) {
    $sql = "SELECT COUNT(*) AS totalArticles FROM articles";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalArticles'];
}

function countTotalNews($conn) {
    $sql = "SELECT COUNT(*) AS totalNews FROM news";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalNews'];
}

function countTotalLawyers($conn) {
    $sql = "SELECT COUNT(*) AS totalLawyers FROM lawyers";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalLawyers'];
}

$totalUsers = countTotalUsers($conn);
$totalAppointments = countTotalAppointments($conn);
$totalArticles = countTotalArticles($conn);
$totalNews = countTotalNews($conn);
$totalLawyers = countTotalLawyers($conn);

?>
<!DOCTYPE html>
<html lang="en">
	 <head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Admin Dashboard</title>
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
		<link href="../admin/assets/css/dash-style.css" rel="stylesheet" />
		<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	 </head>
	<body class="sb-nav-fixed">
			<!-- header -->
			<?php include('../admin/header.php'); ?>
			<div id="layoutSidenav">
					<!-- sidebar -->
				<?php include('../admin/sidebar.php'); ?>
				<div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                   <div class="row">
						<div class="col-xl-3 col-md-6">
							<div class="card bg-primary text-white mb-4">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<div class="h6">Total Users</div>
										<i class="fas fa-users fa-2x"></i>
									</div>
									<div class="h3 mt-3"><?php echo $totalUsers; ?></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-warning text-white mb-4">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<div class="h6">Total Appointments</div>
										<i class="fas fa-calendar-alt fa-2x"></i>
									</div>
									<div class="h3 mt-3"><?php echo $totalAppointments; ?></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-success text-white mb-4">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<div class="h6">Total Lawyers</div>
										<i class="fas fa-user-tie fa-2x"></i>
									</div>
									<div class="h3 mt-3"><?php echo $totalLawyers; ?></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-info text-white mb-4">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<div class="h6">Total Articles</div>
										<i class="far fa-newspaper fa-2x"></i>
									</div>
									<div class="h3 mt-3"><?php echo $totalArticles; ?></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-secondary text-white mb-4">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<div class="h6">Total News</div>
										<i class="far fa-newspaper fa-2x"></i>
									</div>
									<div class="h3 mt-3"><?php echo $totalNews; ?></div>
								</div>
							</div>
						</div>
					</div>

                </div>
            </main>
			<!-- footer -->
			<?php include('../admin/footer.php'); ?>
        </div>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
			</script>
			<script src="../admin/assets/js/script.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
				crossorigin="anonymous"></script>
			<script src="../admin/assets/js/datatables-simple-demo.js"></script>

	</body>
</html>
