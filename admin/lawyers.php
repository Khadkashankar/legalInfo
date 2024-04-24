<?php
include('../includes/connection.php');

// Fetch lawyer records from the database
$query = "SELECT * FROM lawyers";
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
					Lawyers List
				</div>
				<div class="d-flex justify-content-end m-3">
                        <button type="button" class="btn btn-primary" onclick="showAddForm()">+Add Lawyer</button>
                    </div>
				<div class="card-body">
					<table id="datatablesSimple" class="table">
						<thead>
							<tr>
								<th>S.N</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact Number</th>
								<th>Location</th>
								<th>Specialization</th>
								<th>Description</th>
								<th>Profile Picture</th>
								<th>Bar Association Number</th>
								<th>Experience Years</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result->num_rows > 0) {
								$i = 1;
								while ($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td>" . $i++ . "</td>";
									echo "<td>" . $row["name"] . "</td>";
									echo "<td>" . $row["email"] . "</td>";
									echo "<td>" . $row["contact_number"] . "</td>";
									echo "<td>" . $row["location"] . "</td>";
									echo "<td>" . $row["specialization"] . "</td>";
									echo "<td>" . $row["description"] . "</td>";
									echo "<td><img src='" . $row["profile_picture"] . "' alt='Profile Picture' style='width: 100px; height: auto;'></td>";
									echo "<td>" . $row["bar_association_number"] . "</td>";
									echo "<td>" . $row["experience_years"] . "</td>";
									echo "<td>";
									echo "<a href='#editModal' data-toggle='modal' data-id='" . $row['lawyer_id'] . "' data-name='" . $row['name'] . "' data-email='" . $row['email'] . "' data-contact='" . $row['contact_number'] . "' data-location='" . $row['location'] . "' data-specialization='" . $row['specialization'] . "' data-description='" . $row['description'] . "' data-profile-picture='" . $row['profile_picture'] . "' data-bar-association='" . $row['bar_association_number'] . "' data-experience='" . $row['experience_years'] . "'><i class='fas fa-edit'></i></a>";
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";
									echo "<a onclick='confirmDelete(" . $row['lawyer_id'] . ")'><i class='fas fa-trash text-danger'></i></a>";
									echo "</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='11'>No lawyers found</td></tr>";
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

	<!-- Edit Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit Lawyer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editForm">
						<input type="hidden" name="id" id="editLawyerId">
						<div class="form-group">
							<label for="editName">Name</label>
							<input type="text" class="form-control" id="editName" name="name">
						</div>
						<div class="form-group">
							<label for="editEmail">Email</label>
							<input type="email" class="form-control" id="editEmail" name="email">
						</div>
						<div class="form-group">
							<label for="editContact">Contact Number</label>
							<input type="text" class="form-control" id="editContact" name="contact">
						</div>
						<div class="form-group">
							<label for="editLocation">Location</label>
							<input type="text" class="form-control" id="editLocation" name="location">
						</div>
						<div class="form-group">
							<label for="editSpecialization">Specialization</label>
							<input type="text" class="form-control" id="editSpecialization" name="specialization">
						</div>
						<div class="form-group">
							<label for="editDescription">Description</label>
							<textarea class="form-control" id="editDescription" name="description"></textarea>
						</div>
						<div class="form-group">
							<label for="editProfilePicture">Profile Picture</label>
							<input type="text" class="form-control" id="editProfilePicture" name="profile_picture">
						</div>
						<div class="form-group">
							<label for="editBarAssociation">Bar Association Number</label>
							<input type="text" class="form-control" id="editBarAssociation" name="bar_association_number">
						</div>
						<div class="form-group">
							<label for="editExperience">Experience Years</label>
							<input type="text" class="form-control" id="editExperience" name="experience_years">
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

	<!-- Add Modal -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addModalLabel">Add Lawyer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="addForm">
						<input type="hidden" name="id" id="editLawyerId">
						<div class="form-group">
							<label for="addName">Name</label>
							<input type="text" class="form-control" id="addName" name="name">
						</div>
						<div class="form-group">
							<label for="addEmail">Email</label>
							<input type="email" class="form-control" id="addEmail" name="email">
						</div>
						<div class="form-group">
							<label for="addContact">Contact Number</label>
							<input type="text" class="form-control" id="addContact" name="contact">
						</div>
						<div class="form-group">
							<label for="addLocation">Location</label>
							<input type="text" class="form-control" id="addLocation" name="location">
						</div>
						<div class="form-group">
							<label for="addSpecialization">Specialization</label>
							<input type="text" class="form-control" id="addSpecialization" name="specialization">
						</div>
						<div class="form-group">
							<label for="addDescription">Description</label>
							<textarea class="form-control" id="addDescription" name="description"></textarea>
						</div>
						<div class="form-group">
							<label for="addProfilePicture">Profile Picture</label>
							<input type="file" class="form-control" id="addProfilePicture" name="profile_picture">
						</div>
						<div class="form-group">
							<label for="addBarAssociation">Bar Association Number</label>
							<input type="text" class="form-control" id="addBarAssociation" name="bar_association_number">
						</div>
						<div class="form-group">
							<label for="addExperience">Experience Years</label>
							<input type="text" class="form-control" id="addExperience" name="experience_years">
						</div>
					</form>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="addChanges()">Save Changes</button>
				</div>
			</div>
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


	<script>
		// Function to populate form fields with lawyer information when edit icon is clicked
		$('#editModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			var id = button.data('id');
			var name = button.data('name');
			var email = button.data('email');
			var contact = button.data('contact');
			var location = button.data('location');
			var specialization = button.data('specialization');
			var description = button.data('description');
			var profilePicture = button.data('profile-picture');
			var barAssociation = button.data('bar-association');
			var experience = button.data('experience');

			var modal = $(this);
			modal.find('.modal-body #editLawyerId').val(id);
			modal.find('.modal-body #editName').val(name);
			modal.find('.modal-body #editEmail').val(email);
			modal.find('.modal-body #editContact').val(contact);
			modal.find('.modal-body #editLocation').val(location);
			modal.find('.modal-body #editSpecialization').val(specialization);
			modal.find('.modal-body #editDescription').val(description);
			modal.find('.modal-body #editProfilePicture').val(profilePicture);
			modal.find('.modal-body #editBarAssociation').val(barAssociation);
			modal.find('.modal-body #editExperience').val(experience);
		});

		//function to update the lawyer
		function saveChanges() {
			var lawyerId = $('#editLawyerId').val();
			var name = $('#editName').val();
			var email = $('#editEmail').val();
			var contact = $('#editContact').val();
			var location = $('#editLocation').val();
			var specialization = $('#editSpecialization').val();
			var description = $('#editDescription').val();
			var profilePicture = $('#editProfilePicture').val();
			var barAssociation = $('#editBarAssociation').val();
			var experience = $('#editExperience').val();

			$.ajax({
				type: "POST",
				url: "update_lawyers.php",
				data: {
					id: lawyerId,
					name: name,
					email: email,
					contact: contact,
					location: location,
					specialization: specialization,
					description: description,
					profile_picture: profilePicture,
					bar_association_number: barAssociation,
					experience_years: experience
				},
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Lawyer Updated Successfully',
						confirmButtonText: 'OK',
						timer: 3000
					}).then((result) => {
							window.location.reload();
					});
				},
			});
		}

		//function to delete the lawyer
		function confirmDelete(lawyerId) {
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
								url: 'delete_lawyers.php',
								data: { id: lawyerId },
								success: function(response) {
									Swal.fire({
										icon: 'success',
										title: 'Deleted!',
										text: 'Lawyer has been deleted.',
										timer: 1500
									}).then(() => {
										location.reload();
									});
								},
							});
						}
    			});
		}

		//function to show the add modal
		function showAddForm() {
        	$('#addModal').modal('show');
    	}

		//function to add new lawyer
		function addChanges() {
					var name = $('#addName').val();
					var email = $('#addEmail').val();
					var contact = $('#addContact').val();
					var location = $('#addLocation').val();
					var specialization = $('#addSpecialization').val();
					var description = $('#addDescription').val();
					var profilePicture = $('#addProfilePicture').val();
					var barAssociation = $('#addBarAssociation').val();
					var experience = $('#addExperience').val();

        			$.ajax({
						type: "POST",
						url: "add_lawyers.php",
						data: {
							name: name,
							email: email,
							contact: contact,
							location: location,
							specialization: specialization,
							description: description,
							profile_picture: profilePicture,
							bar_association_number: barAssociation,
							experience_years: experience
						},
						success: function(response) {
										console.log(response);
										Swal.fire({
											icon: 'success',
											title: 'Lawyer Added Successfully',
											confirmButtonText: 'OK',
											timer: 3000
										}).then(() => {
											window.location.href = window.location.href;
										});
								},
        			});
		}

	</script>
	<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

</body>

</html>


<?php
// Don't forget to close the database connection
mysqli_close($conn);
?>
