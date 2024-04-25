<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
include('../includes/connection.php');

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
									echo "<td><img src='./lawyerimages/" . $row["profile_picture"] . "' alt='Profile Picture' style='width: 100px; height: auto;'></td>";
									echo "<td>" . $row["bar_association_number"] . "</td>";
									echo "<td>" . $row["experience_years"] . "</td>";
									echo "<td>";
									echo "<a href='#' data-toggle='modal' data-target='#editModal' data-id='" . $row['lawyer_id'] . "' data-name='" . $row['name'] . "' data-email='" . $row['email'] . "' data-contact='" . $row['contact_number'] . "' data-location='" . $row['location'] . "' data-specialization='" . $row['specialization'] . "' data-description='" . $row['description'] . "' data-profile-picture='" . $row['profile_picture'] . "' data-bar-association='" . $row['bar_association_number'] . "' data-experience='" . $row['experience_years'] . "'>
												<i class='fas fa-edit'></i>
												</a>";
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
							<div id="invalid-editName" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editEmail">Email</label>
							<input type="email" class="form-control" id="editEmail" name="email">
							<div id="invalid-editEmail" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editContact">Contact Number</label>
							<input type="text" class="form-control" id="editContact" name="contact">
							<div id="invalid-editContact" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editLocation">Location</label>
							<input type="text" class="form-control" id="editLocation" name="location">
							<div id="invalid-editLocation" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editSpecialization">Specialization</label>
							<input type="text" class="form-control" id="editSpecialization" name="specialization">
							<div id="invalid-editSpecialization" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editDescription">Description</label>
							<textarea class="form-control" id="editDescription" name="description"></textarea>
							<div id="invalid-editDescription" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editProfilePicture">Profile Picture</label>
							<input type="file" class="form-control" id="editProfilePicture" name="profile_picture" onchange="previewImage(this)">
							<img id="currentProfilePicture" src="./lawyerimages/<?php echo $row['profile_picture']; ?>" alt="Current Profile Picture" style="max-width: 100px; max-height: 100px;">
							<img id="editProfilePicturePreview" src="#" alt="New Profile Picture Preview" style="max-width: 100px; max-height: 100px; display: none;">
							<div id="invalid-editProfilePicture" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editBarAssociation">Bar Association Number</label>
							<input type="text" class="form-control" id="editBarAssociation" name="bar_association_number">
							<div id="invalid-editBarAssociation" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="editExperience">Experience Years</label>
							<input type="text" class="form-control" id="editExperience" name="experience_years">
    						<div id="invalid-editExperience" style="color:red"></div><br>
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
    						<div id="invalid-addName" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addEmail">Email</label>
							<input type="email" class="form-control" id="addEmail" name="email">
							<div id="invalid-addEmail" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addContact">Contact Number</label>
							<input type="text" class="form-control" id="addContact" name="contact">
							<div id="invalid-addContact" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addLocation">Location</label>
							<input type="text" class="form-control" id="addLocation" name="location">
							<div id="invalid-addLocation" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addSpecialization">Specialization</label>
							<input type="text" class="form-control" id="addSpecialization" name="specialization">
							<div id="invalid-addSpecialization" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addDescription">Description</label>
							<textarea class="form-control" id="addDescription" name="description"></textarea>
							<div id="invalid-addDescription" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addProfilePicture">Profile Picture</label>
							<input type="file" class="form-control" id="addProfilePicture" name="profile_picture" onchange="previewImage(this)">
							<img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 100px; max-height: 100px;">
							<div id="invalid-addProfilePicture" style="color:red"></div><br>

						</div>
						<div class="form-group">
							<label for="addBarAssociation">Bar Association Number</label>
							<input type="text" class="form-control" id="addBarAssociation" name="bar_association_number">
							<div id="invalid-addBarAssociation" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addExperience">Experience Years</label>
							<input type="text" class="form-control" id="addExperience" name="experience_years">
							<div id="invalid-addExperience" style="color:red"></div><br>
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
			modal.find('.modal-body #currentProfilePicture').attr('src', './lawyerimages/' + profilePicture);
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
					var profilePicture = $("#editProfilePicture")[0].files[0];
					var barAssociation = $('#editBarAssociation').val();
					var experience = $('#editExperience').val();
					var isValid = true;

					if (!name) {
						$("#invalid-editName").text("Name cannot be Empty !");
						var isValid = false;
					}

					if (!email) {
						$("#invalid-editEmail").text("Email cannot be Empty !");
						var isValid = false;
					}

					if (!contact) {
       					 $("#invalid-editContact").text("Contact cannot be Empty!");
       					 isValid = false;
					} else if (contact.length !== 10) {
							$("#invalid-editContact").text("Contact number must be 10 digits long!");
							isValid = false;
					}

					if (!location) {
						$("#invalid-editLocation").text("Location cannot be Empty!");
						var isValid = false;
					}

					if (!specialization) {
						$("#invalid-editSpecialization").text("Specialization cannot be Empty!");
					}

					if (!description) {
						$("#invalid-editDescription").text("Description cannot be Empty!");
						var isValid = false;
					}


					if (!profilePicture) {
						$("#invalid-editProfilePicture").text("Image cannot be Empty!");
						isValid = false;
						} else {
							allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
							if (!allowedExtensions.test(profilePicture.name)) {
								$("#invalid-editProfilePicture").text("Invalid image format! Only JPEG, JPG, or PNG formats are allowed.");
								isValid = false;
						}
   					}

					if (!barAssociation) {
						$("#invalid-editBarAssociation").text("Bar Association Number cannot be Empty!");
						isValid = false;
					} else if (isNaN(barAssociation)) {
						$("#invalid-editBarAssociation").text("Bar Association Number must be numeric!");
						isValid = false;
					}

					if (!experience) {
						$("#invalid-editExperience").text("Experience cannot be Empty!");
						isValid = false;
					} else if (isNaN(experience)) {
						$("#invalid-editExperience").text("Experience must be numeric!");
						isValid = false;
					}

						if (isValid) {
								var formData = new FormData();
								formData.append('id', lawyerId);
								formData.append('name', name);
								formData.append('email', email);
								formData.append('contact', contact);
								formData.append('location', location);
								formData.append('specialization', specialization);
								formData.append('description', description);
								formData.append('profile_picture', profilePicture);
								formData.append('bar_association_number', barAssociation);
								formData.append('experience_years', experience);

							$.ajax({
								type: "POST",
								url: "update_lawyers.php",
								data: formData,
								processData: false,
								contentType: false,
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
					var profilePicture = $("#addProfilePicture")[0].files[0];
					var barAssociation = $('#addBarAssociation').val();
					var experience = $('#addExperience').val();

					var isValid = true;

					if (!name) {
						$("#invalid-addName").text("Name cannot be Empty !");
						var isValid = false;
					}

					if (!email) {
						$("#invalid-addEmail").text("Email cannot be Empty !");
						var isValid = false;
					}

					if (!contact) {
       					 $("#invalid-addContact").text("Contact cannot be Empty!");
       					 isValid = false;
					} else if (contact.length !== 10) {
							$("#invalid-addContact").text("Contact number must be 10 digits long!");
							isValid = false;
					}

					if (!location) {
						$("#invalid-addLocation").text("Location cannot be Empty!");
						var isValid = false;
					}

					if (!specialization) {
						$("#invalid-addSpecialization").text("Specialization cannot be Empty!");
					}

					if (!description) {
						$("#invalid-addDescription").text("Description cannot be Empty!");
						var isValid = false;
					}


					if (!profilePicture) {
						$("#invalid-addProfilePicture").text("Image cannot be Empty!");
						isValid = false;
					} else {
							allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
							if (!allowedExtensions.test(profilePicture.name)) {
								$("#invalid-addProfilePicture").text("Invalid image format! Only JPEG, JPG, or PNG formats are allowed.");
								isValid = false;
						}
   					}

					if (!barAssociation) {
						$("#invalid-addBarAssociation").text("Bar Association Number cannot be Empty!");
						isValid = false;
					} else if (isNaN(barAssociation)) {
						$("#invalid-addBarAssociation").text("Bar Association Number must be numeric!");
						isValid = false;
					}

					if (!experience) {
						$("#invalid-addExperience").text("Experience cannot be Empty!");
						isValid = false;
					} else if (isNaN(experience)) {
						$("#invalid-addExperience").text("Experience must be numeric!");
						isValid = false;
					}

					if (isValid) {
						var formData = new FormData();
						formData.append('name', name);
						formData.append('email', email);
						formData.append('contact', contact);
						formData.append('location', location);
						formData.append('specialization', specialization);
						formData.append('description', description);
						formData.append('profile_picture', profilePicture);
						formData.append('bar_association_number', barAssociation);
						formData.append('experience_years', experience);
						$.ajax({
							type: "POST",
							url: "add_lawyers.php",
							data: formData,
							processData: false,
							contentType: false,
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
		}

		//preview the image
		function previewImage(input) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#imagePreview').attr('src', e.target.result);
					$('#imagePreview').show();
				}

				reader.readAsDataURL(input.files[0]);
		}

		function previewImage(input) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#editProfilePicturePreview').attr('src', e.target.result).show();
				$('#currentProfilePicture').hide(); // Hide the current profile picture
			}

			reader.readAsDataURL(input.files[0]);
		}

		  // clear the error when the field is input for edit
			$("#editName, #editEmail, #editContact, #editLocation, #editSpecialization, #editDescription, #editProfilePicture, #editBarAssociation, #editExperience").on("input", function () {
						var field = $(this).attr("id");
						$("#invalid-" + field).text("");
			});


		  // clear the error when the field is input for add
		  $("#addName, #addEmail, #addContact, #addLocation, #addSpecialization, #addDescription, #addProfilePicture, #addBarAssociation, #addExperience").on("input", function () {
					var field = $(this).attr("id");
					$("#invalid-" + field).text("");
    	});

	</script>
</body>

</html>


<?php
mysqli_close($conn);
?>
