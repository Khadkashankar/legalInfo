<?php
session_start();

if (! isset($_SESSION['id'])) {
    header("Location: ../lawyer/index.php");
    exit();
}
include('../includes/connection.php');

$lawyer_id = $_SESSION['id'];

function countTotalUsers($conn, $lawyer_id) {
    $sql = "SELECT COUNT(DISTINCT user_id) AS total_users FROM appointments WHERE lawyer_id = $lawyer_id;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total_users'];
}

function countTotalAppointments($conn, $lawyer_id) {
    $sql = "SELECT COUNT(*) AS total_appointments FROM appointments WHERE lawyer_id = $lawyer_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total_appointments'];
}

$totalUsers = countTotalUsers($conn, $lawyer_id);
$totalAppointments = countTotalAppointments($conn, $lawyer_id);



?>
<!DOCTYPE html>
<html lang="en">
	 <head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Lawyer Dashboard</title>
		<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
		<link href="../admin/assets/css/dash-style.css" rel="stylesheet" />
		<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	 </head>
	<body class="sb-nav-fixed">
			<!-- header -->
			<?php include('../lawyer/header.php'); ?>
			<div id="layoutSidenav">
					<!-- sidebar -->
				<?php include('../lawyer/sidebar.php'); ?>
				<div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item active">Lawyer Dashboard</li>
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
										<i class="fas fa-calendar fa-2x"></i>
									</div>
									<div class="h3 mt-3"><?php echo $totalAppointments; ?></div>
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
