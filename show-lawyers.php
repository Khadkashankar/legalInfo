<?php

include('./includes/connection.php');

$query = "SELECT * FROM lawyers";
$result = $conn->query($query);

?>

<div class="container-xxl pt-5 pb-3">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Book your lawyer now</h5>
            <h1 class="mb-5">Lawyers</h1>
        </div>
		<div class="row g-4">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-lg-3 col-md-6'>
                <div class='team-item text-center rounded bg-light p-4'>
                    <div class='rounded-circle overflow-hidden mx-auto mb-3 border border-primary' style='width: 100px; height: 100px;'>
                        <img class='img-fluid' src='./lawyerimages/" . $row['profile_picture'] . "' alt='" . $row['name'] . "'>
                    </div>
                    <h5 class='mb-0'>" . $row['name'] . "</h5>
                    <br>
					<b>Contact Number: </b><small class='text-muted'>" . $row['contact_number'] . "</small> <br>
					<b>Location:</b><small class='text-muted'>" . $row['location'] . "</small> <br>
					<b>Specialization: </b><small class='text-muted'>" . $row['specialization'] . "</small> <br>
					<small class='text-muted'>" . $row['experience_years'] . "</small><b> Years Experience</b>
                    <div class='mt-3'>
					<a class='btn btn-sm btn-info' href='./single-lawyer.php?id=" . $row['lawyer_id'] . "'><i class='fa fa-street-view'></i>&nbsp; View Full Profile</a>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo "<p class='col-12'>No lawyers found.</p>";
    }
    ?>
</div>

    </div>
</div>
