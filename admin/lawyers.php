<?php
include('../includes/connection.php');

// Fetch user records from the database
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
								<th>Specialization</th>
								<th>Description</th>
								<th>Bar Association Number</th>
								<th>Experience Years</th>
								<th>Image</th>
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
									echo "<td>" . $row["bar_association_number"] . "</td>";
									echo "<td>" . $row["experience_years"] . "</td>";
									echo "<td><img src='" . $row["profile_picture"] . "' alt='Profile Picture' style='width: 100px; height: auto;'></td>";
									echo "<td>";
									echo "<a href='#editModal' data-toggle='modal' data-id='" . $row['lawyer_id'] . "' data-name='" . $row['name'] . "' data-email='" . $row['email'] . "' data-phone='" . $row['phone_number'] . "' data-address='" . $row['address'] . "'><i class='fas fa-edit'></i></a>";
									echo "&nbsp;&nbsp;&nbsp;&nbsp;";
									echo "<a onclick='confirmDelete(" . $row['lawyer_id'] . ")'><i class='fas fa-trash text-danger'></i></a>";
									echo "</td>";
									echo "</tr>";
								}
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


	<!-- Include Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>


<?php
// Don't forget to close the database connection
mysqli_close($conn);
?>
