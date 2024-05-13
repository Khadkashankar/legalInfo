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
    $barAssociationNumber = $_POST['bar_association_number'];
    $experienceYears = $_POST['experience_years'];

	$pimage=$_FILES["profile_picture"]["name"];
	move_uploaded_file($_FILES["profile_picture"]["tmp_name"],"../lawyerimages/".$_FILES["profile_picture"]["name"]);


    $query = "UPDATE lawyers SET
                name = '$name',
                email = '$email',
                contact_number = '$contact',
                location = '$location',
                specialization = '$specialization',
                description = '$description',
                profile_picture = '$pimage',
                bar_association_number = '$barAssociationNumber',
                experience_years = '$experienceYears'
              WHERE lawyer_id = $lawyerId";

    $result = $conn->query($query);
}

mysqli_close($conn);
?>
