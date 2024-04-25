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
					echo "<div class='col-lg-3 col-md-6 '>
						<div class='team-item text-center rounded '>
						<div class='rounded-circle  m-4'>
							<img class='img-fluid' src='admin/lawyerimages/" . $row['profile_picture'] . "' width='100px' height='100px' alt='" . $row['name'] . "'>
						</div>
						<h5 class='mb-0'>" . $row['name'] . "</h5>
						<small>" . $row['specialization'] . "</small>

					</div>
				</div>";
                }
            } else {
                echo "<p>No lawyers found.</p>";
            }
            ?>
        </div>
    </div>
</div>
