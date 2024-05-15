<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include('./includes/connection.php');

if (isset($_POST['appointment_id']) && !empty($_POST['appointment_id'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    $query = "DELETE FROM appointments WHERE appointment_id = $appointment_id";

    if (mysqli_query($conn, $query)) {
        echo "Appointment cancelled successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
