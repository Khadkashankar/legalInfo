<?php
include('../includes/connection.php');

if(isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];

    $query = "SELECT * FROM appointments WHERE appointment_id = $appointmentId";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $output = "<h4>Appointment Details</h4>";
        $output .= "<p>Date: " . $row['appointment_date'] . "</p>";
        $output .= "<p>Additional Information: " . $row['additional_information'] . "</p>";
        $output .= "<p>Status: " . $row['status'] . "</p>";
        echo $output;
    } 
}
?>
