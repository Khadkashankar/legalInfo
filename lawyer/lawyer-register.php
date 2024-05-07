<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Lawyer Login</title>
	<link href="../lawyer/assets/css/style.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>


</head>

<body class="bg-primary">
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">

								<div class="card-header">
									<h3 class="text-center font-weight-light my-4">Lawyer Login</h3>
								</div>
								<div class="card-body">

									<form method="post" action="add-lawyers.php" enctype="multipart/form-data">

									<div class="form-floating mb-3">
											<input class="form-control" name="name" id="name" type="text" placeholder="Name" required />
											<label for="inputName">Name</label>
											<div id="invalid-name" style="color:red"></div><br>
										</div>
										<div class="form-floating mb-3">
											<input class="form-control" name="email" id="email" type="email" placeholder="Email" required />
											<label for="inputEmail">Email</label>
											<div id="invalid-email" style="color:red"></div><br>

										</div>
										<div class="form-floating mb-3">
											<input class="form-control" name="contact" id="contact" type="number" placeholder="Contact Number" required />
											<label for="inputContactNumber">Contact Number</label>
											<div id="invalid-contact" style="color:red"></div><br>

										</div>
										<div class="form-floating mb-3">
											<input class="form-control" name="location" id="location" type="text" placeholder="Location" required />
											<label for="inputLocation">Location</label>
											<div id="invalid-location" style="color:red"></div><br>

										</div>

										<div class="form-floating mb-3">
											<input class="form-control" name="specialization" id="specialization" type="text" placeholder="Specialization" required />
											<label for="inputSpecialization">Specialization</label>											<div id="invalid-name" style="color:red"></div><br>
											<div id="invalid-specialization" style="color:red"></div><br>

										</div>
										<div class="form-floating mb-3">
											<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
											<label for="inputDescription">Description</label>
											<div id="invalid-description" style="color:red"></div><br>

										</div>
										<div class="form-floating mb-3">
										<input class="form-control" name="barAssociationNumber" id="barAssociationNumber" type="number" placeholder="Bar Association Number" required />

											<label for="inputBarAssociationNumber">Bar Association Number</label>
											<div id="invalid-barAssociationNumber" style="color:red"></div><br>

										</div>
										<div class="form-floating mb-3">
										<input class="form-control" name="experienceYear" id="experienceYear" type="number" placeholder="Experience Year" required />
											<label for="inputExperienceYear">Experience Years</label>
											<div id="invalid-experienceYear" style="color:red"></div><br>

										</div>
										<label for="inputImage">Image</label>
										<div class="form-floating mb-3">
										<input class="form-control" name="image" id="image" type="file" placeholder="Profile Picture" required />
										<div id="invalid-image" style="color:red"></div><br>
									</div>


										<div class="form-floating mb-3 d-flex align-items-center">
											<input class="form-control" name="password" id="password" type="password" placeholder="Password" id="password" required />
											<label for="inputPassword">Password</label>
											<span class="m-4 position-absolute end-0">
												<i class="fas fa-eye" id="togglePassword" onclick="togglePasswordVisibility()"></i>
											</span>
										</div>
										<div id="invalid-password" style="color:red"></div><br>


										<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
											<p>Already have an account?<a class="small" href="../lawyer/index.php">Login</a>
											</p>
											<button type="submit" class="btn btn-primary">Register</button>
										</div>
									</form>
								</div>
								<div class="card-footer text-center py-3">
									<div class="small"><a href="../index.php">Back to Home Page</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../lawyer/assets/js/script.js"></script>



	<script>
			function togglePasswordVisibility() {
				var x = document.getElementById("password");
				var toggleIcon = document.getElementById("togglePassword");

				if (x.type === "password") {
					x.type = "text";
					toggleIcon.classList.remove("fa-eye");
					toggleIcon.classList.add("fa-eye-slash");
				} else {
					x.type = "password";
					toggleIcon.classList.remove("fa-eye-slash");
					toggleIcon.classList.add("fa-eye");
				}
			}

			//function to register new lawyer
		function addChanges() {
					var name = $('#name').val();
					var email = $('#email').val();
					var contact = $('#contact').val();
					var location = $('#location').val();
					var specialization = $('#specialization').val();
					var description = $('#description').val();
					var image = $("#image")[0].files[0];
					var barAssociation = $('#barAssociationNumber').val();
					var experience = $('#experienceYear').val();
					var password = $('#password').val();

					var isValid = true;

					if (!name) {
						$("#invalid-name").text("Name cannot be Empty !");
						var isValid = false;
					}

					if (!email) {
						$("#invalid-email").text("Email cannot be Empty !");
						var isValid = false;
					}

					if (!contact) {
       					 $("#invalid-contact").text("Contact cannot be Empty!");
       					 isValid = false;
					} else if (contact.length !== 10) {
							$("#invalid-contact").text("Contact number must be 10 digits long!");
							isValid = false;
					}

					if (!location) {
						$("#invalid-location").text("Location cannot be Empty!");
						var isValid = false;
					}

					if (!specialization) {
						$("#invalid-specialization").text("Specialization cannot be Empty!");
					}

					if (!description) {
						$("#invalid-description").text("Description cannot be Empty!");
						var isValid = false;
					}


					if (!image) {
						$("#invalid-image").text("Image cannot be Empty!");
						isValid = false;
					} else {
							allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
							if (!allowedExtensions.test(image.name)) {
								$("#invalid-image").text("Invalid image format! Only JPEG, JPG, or PNG formats are allowed.");
								isValid = false;
						}
   					}

					if (!barAssociation) {
						$("#invalid-barAssociationNumber").text("Bar Association Number cannot be Empty!");
						isValid = false;
					} else if (isNaN(barAssociation)) {
						$("#invalid-barAssociationNumber").text("Bar Association Number must be numeric!");
						isValid = false;
					}

					if (!experience) {
						$("#invalid-experienceYear").text("Experience cannot be Empty!");
						isValid = false;
					} else if (isNaN(experience)) {
						$("#invalid-experienceYear").text("Experience must be numeric!");
						isValid = false;
					}
					if (!password) {
						$("#invalid-password").text("Password cannot be Empty!");
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
						formData.append('image', image);
						formData.append('barAssociation', barAssociation);
						formData.append('experience', experience);
						formData.append('password', password);
						$.ajax({
							type: "POST",
							url: "add_lawyers.php",
							data: formData,
							processData: false,
							contentType: false,
							success: function(response) {
											Swal.fire({
												icon: 'success',
												title: 'Lawyer Registered Successfully',
												confirmButtonText: 'OK',
												timer: 3000
											}).then(() => {
												window.location.href = 'index.php';
											});
									},
						});
					}
		}
</script>

</body>

</html>
