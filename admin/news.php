<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
include('../includes/connection.php');

$query = "SELECT * FROM news";
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
					Dashboard / News
				</div>
				<div class="d-flex justify-content-end m-3">
                        <button type="button" class="btn btn-primary" onclick="showAddForm()">+Add News</button>
                    </div>
				<div class="card-body">
					<table id="datatablesSimple" class="table">
						<thead>
							<tr>
								<th>S.N</th>
								<th>News Title</th>
								<th>Content</th>
								<th>Description</th>
								<th>Image</th>
								<th>Status</th>
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
									echo "<td>" . $row["title"] . "</td>";
									echo "<td>" . $row["content"] . "</td>";
									echo "<td>" . $row["description"] . "</td>";
									echo "<td><img src='./newsimages/" . $row["image"] . "' alt='Profile Picture' style='width: 100px; height: auto;'></td>";
									echo "<td>" . $row["status"] . "</td>";
									echo "<td>";
									echo "<a href='#' data-toggle='modal' data-target='#editNewsModal' data-id='" . $row['news_id'] . "' data-title='" . $row['title'] . "' data-content='" . $row['content'] . "' data-description='" . $row['description'] . "' data-image='" . $row['image'] . "' data-status='" . $row['status'] . "'>
												<i class='fas fa-edit'></i>
												</a>";
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";
									echo "<a onclick='confirmDelete(" . $row['news_id'] . ")'><i class='fas fa-trash text-danger'></i></a>";
									echo "</td>";
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='11'>No news found</td></tr>";
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
	<div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="editNewsModalLabel">Edit Lawyer</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editNewsForm">
						<input type="hidden" name="id" id="editNewsId">
						<div class="form-group">
							<label for="editNewsTitle">News Title</label>
							<input type="text" class="form-control" id="editNewsTitle" name="title">
							<div id="invalid-editNewsTitle" style="color:red"></div><br>
						</div>
							<div class="form-group">
								<label for="editNewsContent">Content</label>
								<div id="editNewsContentEditor"></div>
								<input type="hidden" id="editNewsContent" name="content">
								<div id="invalid-editNewsContent" style="color:red"></div><br>
                    		</div>
                    			<div class="form-group">
									<label for="editNewsDescription">Description</label>
									<div id="editNewsDescriptionEditor"></div>
									<input type="hidden" id="editNewsDescription" name="description">
									<div id="invalid-editNewsDescription" style="color:red"></div><br>
                    			</div>
						<div class="form-group">
							<label for="editNewsImage">Images</label>
							<input type="file" class="form-control" id="editNewsImage" name="image" onchange="previewImage(this)">
							<img id="currentNewsImage" src="./newsimages/<?php echo $row['image']; ?>" alt="Current Image" style="max-width: 100px; max-height: 100px;">
							<img id="editNewsImagePreview" src="#" alt="New Image" style="max-width: 100px; max-height: 100px; display: none;">
							<div id="invalid-editNewsImage" style="color:red"></div><br>
						</div>
						<div class="form-group">
                        <label for="editNewsStatus">Status</label>
                        <select class="form-control" id="editNewsStatus" name="status">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
						<div id="invalid-editNewsStatus" style="color:red"></div><br>
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
	<div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
   		<div class="modal-dialog" role="document">
        	<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewsModalLabel">Add News</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewsForm">
                    <div class="form-group">
                        <label for="addTitle">News Title</label>
                        <input type="text" class="form-control" id="addTitle" name="title">
                        <div id="invalid-addTitle" style="color:red"></div><br>
                    </div>
                    	<div class="form-group">
							<label for="addContent">Content</label>
							<div id="addContentEditor"></div>
								<input type="hidden" id="addContent" name="content">
								<div id="invalid-addContent" style="color:red"></div><br>
						</div>
						<div class="form-group">
							<label for="addDescription">Description</label>
							<div id="addDescriptionEditor"></div>
							<input type="hidden" id="addDescription" name="description">
							<div id="invalid-addDescription" style="color:red"></div><br>
						</div>

                    <div class="form-group">
                        <label for="addImage">Image</label>
                        <input type="file" class="form-control" id="addImage" name="image" onchange="previewImage(this)">
                        <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 100px; max-height: 100px;">
                        <div id="invalid-addImage" style="color:red"></div><br>
                    </div>
                    <div class="form-group">
                        <label for="addStatus">Status</label>
                        <select class="form-control" id="addStatus" name="status">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
						<div id="invalid-addStatus" style="color:red"></div><br>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addNews()">Add News</button>
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
					<script src="../admin/assets/js/main.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
					<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2"></script>
					<script src="../admin/assets/js/datatables-simple-demo.js"></script>

					<!-- ck editor -->
					<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>


	<script>
		// Function to populate form fields with lawyer information when edit icon is clicked
		$('#editNewsModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var title = button.data('title');
    var content = button.data('content');
    var description = button.data('description');
    var image = button.data('image');
    var status = button.data('status');

    var modal = $(this);
    modal.find('.modal-body #editNewsId').val(id);
    modal.find('.modal-body #editNewsTitle').val(title);
    modal.find('.modal-body #currentNewsImage').attr('src', './newsimages/' + image);
    modal.find('.modal-body #editNewsStatus').val(status);

				if (content) {
					if (!modal.data('contentEditor')) {
						ClassicEditor
							.create(document.querySelector('#editNewsContentEditor'))
							.then(editor => {
								modal.data('contentEditor', editor);
								editor.setData(content); 
								editor.model.document.on('change', () => {
									$('#editNewsContent').val(editor.getData());
								});
								modal.find('.modal-body #editNewsContent').val(content);
							})
							.catch(error => {
								console.error(error);
							});
					} else {
						modal.data('contentEditor').setData(content);
					}
				}

			if (description) {
				if (!modal.data('descriptionEditor')) {
					ClassicEditor
						.create(document.querySelector('#editNewsDescriptionEditor'))
						.then(editor => {
							modal.data('descriptionEditor', editor);
							editor.setData(description);
							editor.model.document.on('change', () => {
								$('#editNewsDescription').val(editor.getData());
							});
							modal.find('.modal-body #editNewsDescription').val(description);

						})
						.catch(error => {
							console.error(error);
						});
				} else {
					modal.data('descriptionEditor').setData(description);
				}
			}
});


		//function to update the lawyer
		function saveChanges() {
					var newsId = $('#editNewsId').val();
					var title = $('#editNewsTitle').val();
					var content = $('#editNewsContent').val();
					var description = $('#editNewsDescription').val();
					var image = $("#editNewsImage")[0].files[0];
					var status = $('#editNewsStatus').val();
					var isValid = true;

					if (!title) {
						$("#invalid-editNewsTitle").text("Title cannot be Empty !");
						var isValid = false;
					}

					if (!image) {
						$("#invalid-editNewsImage").text("Image cannot be Empty!");
						isValid = false;
						} else {
							allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
							if (!allowedExtensions.test(image.name)) {
								$("#invalid-editNewsImage").text("Invalid image format! Only JPEG, JPG, or PNG formats are allowed.");
								isValid = false;
						}
   					}

					if (!status) {
						$("#invalid-editNewsStatus").text("Please select one status!");
						isValid = false;
					}

						if (isValid) {
								var formData = new FormData();
								formData.append('id', newsId);
								formData.append('title', title);
								formData.append('content', content);
								formData.append('description', description);
								formData.append('image', image);
								formData.append('status', status);

							$.ajax({
								type: "POST",
								url: "update_news.php",
								data: formData,
								processData: false,
								contentType: false,
								success: function(response) {
									Swal.fire({
										icon: 'success',
										title: 'News Updated Successfully',
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
		function confirmDelete(newsId) {
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
								url: 'delete_news.php',
								data: { id: newsId },
								success: function(response) {
									Swal.fire({
										icon: 'success',
										title: 'Deleted!',
										text: 'News has been deleted.',
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
        	$('#addNewsModal').modal('show');
    	}

		//function to add new lawyer
		function addNews() {
					var title = $('#addTitle').val();
					var content = $('#addContent').val();
					var description = $('#addDescription').val();
					var image = $("#addImage")[0].files[0];
					var status = $('#addStatus').val();

					var isValid = true;

					if (!title) {
						$("#invalid-addTitle").text("Title cannot be Empty !");
						var isValid = false;
					}

					if (!image) {
						$("#invalid-addImage").text("Image cannot be Empty!");
						isValid = false;
					} else {
							allowedExtensions = /(\.jpeg|\.jpg|\.png)$/i;
							if (!allowedExtensions.test(image.name)) {
								$("#invalid-addImage").text("Invalid image format! Only JPEG, JPG, or PNG formats are allowed.");
								isValid = false;
						}
   					}

					   if (!status) {
						$("#invalid-addStatus").text("Please select one status!");
						var isValid = false;
					}

					if (isValid) {
						var formData = new FormData();
						formData.append('title', title);
						formData.append('content', content);
						formData.append('description', description);
						formData.append('image', image);
						formData.append('status', status);
						$.ajax({
							type: "POST",
							url: "add_news.php",
							data: formData,
							processData: false,
							contentType: false,
							success: function(response) {
											console.log(response);
											Swal.fire({
												icon: 'success',
												title: 'News Added Successfully',
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
				$('#editNewsImagePreview').attr('src', e.target.result).show();
				$('#currentNewsImage').hide();
			}

			reader.readAsDataURL(input.files[0]);
		}

		  // clear the error when the field is input for edit
			$("#editNewsTitle, #editNewsContent, #editNewsDescription, #editNewsImage, #editNewsStatus").on("input", function () {
						var field = $(this).attr("id");
						$("#invalid-" + field).text("");
			});


		  // clear the error when the field is input for add
		  $("#addTitle, #addContent, #addDescription, #addImage, #addStatus").on("input", function () {
					var field = $(this).attr("id");
					$("#invalid-" + field).text("");
    	});

	</script>
</body>

</html>


<?php
mysqli_close($conn);
?>
