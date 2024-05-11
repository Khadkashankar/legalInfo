<?php

session_start();

if (!isset($_SESSION['login'] ) ) {
    header("Location: index.php");
    exit();
}
include('../includes/connection.php');

$query = "SELECT * FROM appointments";
$result = $conn->query($query);

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
					Dashboard / Appointments
				</div>
				<div class="card-body">
					<table id="datatablesSimple" class="table">
						<thead>
							<tr>
								<th>S.N</th>
								<th>User ID</th>
								<th>Lawyer ID</th>
								<th>Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result->num_rows > 0) {
								$i = 1;
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>" . $i++ . "</td>";
									echo "<td>" . $row['user_id'] . "</td>";
									echo "<td>" . $row['lawyer_id'] . "</td>";
									echo "<td>" . $row['appointment_date'] . "</td>";
									echo "<td>" . $row['status'] . "</td>";
									echo "<td>";
									if ($row['status'] != 'confirmed') {
                                        echo "<button class='btn btn-sm btn-success' onclick='confirmAppointment(" . $row['appointment_id'] . ")'>Confirm</button>";
                                    }
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";

									echo "<button class='btn btn-sm btn-danger' onclick='cancelAppointment(" . $row['appointment_id'] . ")'>Delete</button>";
									echo "</td>";
									echo "</tr>";
								}
							} else {
									echo "<tr><td colspan='11'>No appointments found</td></tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- footer -->
			<?php include('footer.php'); ?>

		</div>
	</div>

			<!-- Include Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
			<script src="../admin/assets/js/script.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
			<script src="../admin/assets/js/datatables-simple-demo.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


			<script>
				// Function to confirm appointment
				function confirmAppointment(appointmentId) {
					$.ajax({
						type: 'POST',
						url: 'confirm-appointment.php',
						data: { appointment_id: appointmentId },
						success: function(response) {
							location.reload();
						},
						error: function(xhr, status, error) {
							console.error(xhr.responseText);
						}
					});
				}

				// Function to cancel appointment
				function cancelAppointment(appointmentId) {
					Swal.fire({
						title: 'Are you sure?',
						text: 'This appointment will be cancelled!',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, cancel it!'
					}).then((result) => {
						if (result.isConfirmed) {
							$.ajax({
								type: 'POST',
								url: 'cancel-appointment.php',
								data: { appointment_id: appointmentId },
								success: function(response) {
									location.reload();
								},
								error: function(xhr, status, error) {
									console.error(xhr.responseText);
								}
							});
						}
					});
				}

			</script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>


<?php
mysqli_close($conn);
?>
