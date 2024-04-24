<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['id'])) {
		$lawyerId = $_POST['id'];

		$query = "DELETE FROM lawyers WHERE lawyer_id = $lawyerId";
		$result = $conn->query($query);
	}
}

mysqli_close($conn);
?>
