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
		<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
		<style>
        .lawyer-details {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .lawyer-details h4 {
            margin-top: 0;
        }
    </style>
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
					<?php
                    // Include database connection
                    include('../includes/connection.php');

                    // Fetch data from the database
                    $query = "SELECT * FROM lawyers";
                    $result = $conn->query($query);

                    // Display data
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="lawyer-details">';
                        echo '<h4>' . $row['name'] . '</h4>';
                        echo '<p><strong>Email:</strong> ' . $row['email'] . '</p>';
                        echo '<p><strong>Phone:</strong> ' . $row['phone'] . '</p>';
                        // Add more fields as needed
                        echo '</div>';
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </div>
            </main>
			<!-- footer -->
			<?php include('../admin/footer.php'); ?>
        </div>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
			</script>
			<script src="../admin/assets/js/script.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
				crossorigin="anonymous"></script>
			<script src="../admin/assets/js/datatables-simple-demo.js"></script>

	</body>
</html>
