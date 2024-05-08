<?php
include('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $specialization = $_POST['specialization'];
    $description = $_POST['description'];
    $barAssociation = $_POST['bar_association_number'];
    $experience = $_POST['experience_years'];

	$images=$_FILES["profile_picture"]["name"];
  	move_uploaded_file($_FILES["profile_picture"]["tmp_name"],"../lawyerimages/".$_FILES["profile_picture"]["name"]);

    $query = "INSERT INTO lawyers (name, email, contact_number, location, specialization, description, profile_picture, bar_association_number, experience_years)
              VALUES ('$name', '$email', '$contact', '$location', '$specialization', '$description', '$images', '$barAssociation', '$experience')";
    $result = $conn->query($query);
}
mysqli_close($conn);
?>
