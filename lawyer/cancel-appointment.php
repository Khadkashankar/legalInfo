<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

include('../includes/connection.php');

// Check if appointment ID is set and not empty
if (isset($_POST['appointment_id']) && !empty($_POST['appointment_id'])) {
    // Sanitize the appointment ID to prevent SQL injection
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);

    // Perform the cancellation
    $query = "DELETE FROM appointments WHERE appointment_id = $appointment_id";

    if (mysqli_query($conn, $query)) {
        // Appointment successfully cancelled
        echo "Appointment cancelled successfully.";
    } else {
        // Error occurred while cancelling the appointment
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If appointment ID is not set or empty, return an error message
    echo "Invalid appointment ID.";
}

// Close the connection
mysqli_close($conn);
?>
