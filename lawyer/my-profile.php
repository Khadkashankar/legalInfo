<?php
    session_start();

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit();
    }

    $id = $_SESSION['id'];

    include('../includes/connection.php');

    $query = "SELECT * FROM lawyers WHERE lawyer_id = $id";
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
		<!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
		<!-- Include Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
									<button class="btn btn-primary edit-lawyer" data-toggle="modal" data-target="#editModal" data-id="<?php echo $row['lawyer_id']; ?>" data-name="<?php echo $row['name']; ?>" data-email="<?php echo $row['email']; ?>" data-contact="<?php echo $row['contact_number']; ?>" data-location="<?php echo $row['location']; ?>" data-specialization="<?php echo $row['specialization']; ?>" data-description="<?php echo $row['description']; ?>" data-profile-picture="<?php echo $row['profile_picture']; ?>" data-bar-association="<?php echo $row['bar_association_number']; ?>" data-experience="<?php echo $row['experience_years']; ?>">
											<i class="fas fa-edit"></i> Edit Details
										</button>
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
											<img id="currentProfilePicture" src="../lawyerimages/<?php echo $row['profile_picture']; ?>" alt="Current Profile Picture" style="max-width: 100px; max-height: 100px;">
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
            </main>
			<!-- footer -->
			<?php include('../admin/footer.php'); ?>
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
				modal.find('.modal-body #currentProfilePicture').attr('src', '../lawyerimages/' + profilePicture);
				modal.find('.modal-body #editBarAssociation').val(barAssociation);
				modal.find('.modal-body #editExperience').val(experience);


				// Create a File object from the Blob
				fetch('../lawyerimages/' + profilePicture)
									.then(response => response.blob())
									.then(blob => {
										const file = new File([blob], profilePicture);
										const fileList = new DataTransfer();
										fileList.items.add(file);
										const fileInput = modal.find('.modal-body #editProfilePicture')[0];
										fileInput.files = fileList.files;
									})
									.catch(error => {
										console.error('Error fetching image:', error);
									});
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

			function previewImage(input) {
					var reader = new FileReader();

					reader.onload = function(e) {
						$('#editProfilePicturePreview').attr('src', e.target.result).show();
						$('#currentProfilePicture').hide();
					}

					reader.readAsDataURL(input.files[0]);
			}

					// clear the error when the field is input for edit
					$("#editName, #editEmail, #editContact, #editLocation, #editSpecialization, #editDescription, #editProfilePicture, #editBarAssociation, #editExperience").on("input", function () {
								var field = $(this).attr("id");
								$("#invalid-" + field).text("");
					});
	</script>

	</body>
</html>
