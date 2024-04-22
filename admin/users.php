<?php
include('../includes/connection.php');

// Fetch user records from the database
$query = "SELECT * FROM users";
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
					Register User
				</div>
				<div class="card-body">
					<table id="datatablesSimple" class="table">
						<thead>
							<tr>
								<th>S.N</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>" . $i++ . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['email'] . "</td>";
								echo "<td>" . $row['phone_number'] . "</td>";
								echo "<td>" . $row['address'] . "</td>";
								echo "<td>";
								echo "<a href='#editModal' data-toggle='modal' data-id='" . $row['user_id'] . "' data-name='" . $row['name'] . "' data-email='" . $row['email'] . "' data-phone='" . $row['phone_number'] . "' data-address='" . $row['address'] . "'><i class='fas fa-edit'></i></a>";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;";
								echo "<a onclick='confirmDelete(" . $row['user_id'] . ")'><i class='fas fa-trash text-danger'></i></a>";
								echo "</td>";
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- footer -->
			<?php include('footer.php'); ?>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
			<script src="../admin/assets/js/script.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
			<script src="../admin/assets/js/datatables-simple-demo.js"></script>
		</div>
	</div>

	<!-- Edit Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<input type="hidden" name="id" id="editUserId">
						<div class="form-group">
							<label for="editName">Name</label>
							<input type="text" class="form-control" id="editName" name="name">
						</div>
						<div class="form-group">
							<label for="editEmail">Email</label>
							<input type="email" class="form-control" id="editEmail" name="email">
						</div>
						<div class="form-group">
							<label for="editPhone">Phone</label>
							<input type="text" class="form-control" id="editPhone" name="phone">
						</div>
						<div class="form-group">
							<label for="editAddress">Address</label>
							<textarea class="form-control" id="editAddress" name="address"></textarea>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="saveChanges()">Save Changes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Include Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


	<script>
		// Function to populate form fields with user information when edit icon is clicked
		$('#editModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			var id = button.data('id');
			var name = button.data('name');
			var email = button.data('email');
			var phone = button.data('phone');
			var address = button.data('address');

			var modal = $(this);
			modal.find('.modal-body #editUserId').val(id);
			modal.find('.modal-body #editName').val(name);
			modal.find('.modal-body #editEmail').val(email);
			modal.find('.modal-body #editPhone').val(phone);
			modal.find('.modal-body #editAddress').val(address);
		});

		//function to update the user
		function saveChanges() {
			var userId = $('#editUserId').val();
			var name = $('#editName').val();
			var email = $('#editEmail').val();
			var phone = $('#editPhone').val();
			var address = $('#editAddress').val();

			$.ajax({
				type: "POST",
				url: "update_user.php",
				data: {
					id: userId,
					name: name,
					email: email,
					phone: phone,
					address: address
				},
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'User Updated Successfully',
						confirmButtonText: 'OK',
						timer: 3000
					}).then((result) => {
							location.reload();
					});
				},
			});
		}

		//function to delete the user
		function confirmDelete(userId) {
					Swal.fire({
						title: 'Are you sure?',
						text: 'You won\'t be able to revert this!',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#d33',
						cancelButtonColor: '#3085d6',
						confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
						if (result.isConfirmed) {
							$.ajax({
								type: 'POST',
								url: 'delete_user.php',
								data: { id: userId },
								success: function(response) {
									Swal.fire({
										icon: 'success',
										title: 'Deleted!',
										text: 'User has been deleted.',
										timer: 1500
									}).then(() => {
										location.reload();
									});
								},
							});
						}
    			});
		}

	</script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>


<?php
// Don't forget to close the database connection
mysqli_close($conn);
?>
