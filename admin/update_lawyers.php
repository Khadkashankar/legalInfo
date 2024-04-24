<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lawyerId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $specialization = $_POST['specialization'];
    $description = $_POST['description'];
    $profilePicture = $_POST['profile_picture'];
    $barAssociationNumber = $_POST['bar_association_number'];
    $experienceYears = $_POST['experience_years'];

    $query = "UPDATE lawyers SET
                name = '$name',
                email = '$email',
                contact_number = '$contact',
                location = '$location',
                specialization = '$specialization',
                description = '$description',
                profile_picture = '$profilePicture',
                bar_association_number = '$barAssociationNumber',
                experience_years = '$experienceYears'
              WHERE lawyer_id = $lawyerId";
			  
    $result = $conn->query($query);
}

mysqli_close($conn);
?>
