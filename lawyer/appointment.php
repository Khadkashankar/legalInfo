<?php

session_start();

include('../includes/connection.php');

if (!isset($_SESSION['id'] ) ) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];

// Fetch user records from the database
$query = "SELECT * FROM appointments WHERE lawyer_id =$id";
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
	<title>Lawyer Dashboard</title>
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
								<th>Date</th>
								<th>Description</th>
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
									echo "<td>" . $row['appointment_date'] . "</td>";
									echo "<td>" . $row['additional_information'] . "</td>";
									echo "<td>" . $row['status'] . "</td>";
									echo "<td>";
									// Confirm Button
									if ($row['status'] != 'confirmed') {
                                        echo "<button class='btn btn-sm btn-success' onclick='confirmAppointment(" . $row['appointment_id'] . ")'>Confirm</button>";
                                    }
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";

									// Cancel Button
									echo "<button class='btn btn-sm btn-danger' onclick='cancelAppointment(" . $row['appointment_id'] . ")'>Delete</button>";
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";

									echo "<button class='btn btn-sm btn-info' onclick='viewDetails(" . $row['user_id'] .",". $row['appointment_id'] . ")'>View Details</button>";
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
			<?php include('../admin/footer.php'); ?>

		</div>
	</div>
		<!-- User Details Modal -->
			<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="userDetailsModalLabel">User and Appointment Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
							<div id="userDetails"></div>
							<hr>
							<div id="appointmentDetails"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>


			<!-- Include Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
			<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
			<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

			<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
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
							// Handle error response
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
								url: 'cancel-appointment.php', // Your PHP script to handle cancellation
								data: { appointment_id: appointmentId },
								success: function(response) {
									location.reload();
								},
								error: function(xhr, status, error) {
									// Handle error response
									console.error(xhr.responseText);
								}
							});
						}
					});
				}

   				 // Function to view user details
					function viewDetails(userId, appointmentId) {
   						 // Fetch user details
						jQuery.ajax({
							type: 'POST',
							url: 'fetch-user-details.php',
							data: { user_id: userId },
							success: function(userResponse) {
								// Populate modal with user details
								$('#userDetailsModal .modal-body #userDetails').html(userResponse);

								// Fetch appointment details
								$.ajax({
									type: 'POST',
									url: 'fetch-appointment-details.php',
									data: { appointment_id: appointmentId },
									success: function(appointmentResponse) {
										// Populate modal with appointment details
										$('#userDetailsModal .modal-body #appointmentDetails').html(appointmentResponse);

										// Show the modal
										$('#userDetailsModal').modal('show');
									},
									error: function(xhr, status, error) {
										// Handle error response for appointment details
										console.error(xhr.responseText);
									}
								});
							},
							error: function(xhr, status, error) {
								// Handle error response for user details
								console.error(xhr.responseText);
							}
						});
					}



			</script>

</body>

</html>


<?php
mysqli_close($conn);
?>
