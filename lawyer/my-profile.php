<?php
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION['id'];

    include('../includes/connection.php');

    $query = "SELECT * FROM lawyers WHERE lawyer_id = $user_id";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
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
                        <li class="breadcrumb-item active">My Profile</li>
                    </ol>
					<div class="container mt-5">
					<div class="row">
						<div class="col-md-6 offset-md-3">
						<div class="card">
							<div class="card-header bg-primary text-white">
							My Details
							</div>
							<div class="card-body">
									<div class="row">
									<div class="col-md-3">
            <img src="../lawyerimages/<?php echo $row['profile_picture']; ?>" alt="Lawyer Image" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Contact Number:</strong> <?php echo $row['contact_number']; ?></p>
            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
            <p><strong>Specialization:</strong> <?php echo $row['specialization']; ?></p>
            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
            <p><strong>Bar Association Number:</strong> <?php echo $row['bar_association_number']; ?></p>
            <p><strong>Experience Years:</strong> <?php echo $row['experience_years']; ?></p>
        </div>
									</div>
									<div class="text-center mt-3">
										<button class="btn btn-primary">Edit Details</button>
									</div>
									<?php
										}
									?>
							</div>
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
