<?php
include('../includes/connection.php');

if (isset($_POST['appointment_id']) && !empty($_POST['appointment_id'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    $query = "DELETE FROM appointments WHERE appointment_id = $appointment_id";

    $result = $conn->query($query);
}
mysqli_close($conn);
?>
