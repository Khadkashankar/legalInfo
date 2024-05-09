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
	<link href="../lawyer/assets/css/dash-style.css" rel="stylesheet" />

	<!-- Include Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="sb-nav-fixed">
	<!-- header -->
	<?php include('header.php'); ?>

	<div id="layoutSidenav">
		<!-- sidebar -->
		<?php include('sidebar.php'); ?>
		<div id="layoutSidenav_content">

			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-table me-1"></i>
					Dashboard / Lawyers
				</div>
				<div class="card-body">
					<table id="datatablesSimple" class="table">
						<thead>
							<tr>

							</tr>
						</thead>
						<tbody>
							<!--  -->
						</tbody>
					</table>
				</div>
			</div>

			<!-- footer -->
			<?php include('../admin/footer.php'); ?>

		</div>
	</div>

	<!-- Include Bootstrap JS -->
					<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
					<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
					<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
					<script src="../admin/assets/js/script.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
					<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2"></script>
					<script src="../admin/assets/js/datatables-simple-demo.js"></script>
</body>

</html>
