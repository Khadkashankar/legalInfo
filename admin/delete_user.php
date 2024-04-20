<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['id'])) {
		$userId = $_POST['id'];

		$query = "DELETE FROM users WHERE user_id = $userId";
		$result = $conn->query($query);
	}
}

mysqli_close($conn);
?>
