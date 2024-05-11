
<section>
			<div class="container">
				<div class="row">
					<?php
						// session_start();
				include('./includes/connection.php'); // Update to your connection file
							// Check if id is set and is a number
							if(isset($_GET['id']) && is_numeric($_GET['id'])) {
								$lawyer_id = $_GET['id'];
								// Prepare and execute the SQL query
								$query = "SELECT * FROM lawyers WHERE lawyer_id = $lawyer_id";
								$result = $conn->query($query);

								// Check if query was successful
								if ($result && $result->num_rows > 0) {
									// Fetch data and display profile
									while($row = $result->fetch_assoc()) {
										?>
						<div class="col-md-3">
							<div class="sideprofile">
								<img src="./lawyerimages/<?php echo $row["profile_picture"]; ?>" class="img-fluid profile_img" alt="profile picture">
								<h2><?php echo $row["name"]; ?> </h2>
								<h4><?php echo $row["specialization"]; ?></h4>
								<hr>
							</div>
						</div>
						<div class="col-md-9">
							<div class="mainprofile">
								<div class="infogroup row">
									<div class="col-md-4">
										<label for="contact"><strong>Contact number :</strong></label>
									</div>
									<div class="col-md-8">
										<p><?php echo $row["contact_number"]; ?></p>
									</div>
								</div>
								<div class="infogroup row">
									<div class="col-md-4">
										<label for="email"><b>Email :</b></label>
									</div>
									<div class="col-md-8">
										<p><?php echo $row["email"]; ?></p>
									</div>
								</div>
								<div class="infogroup row">
									<div class="col-md-4">
										<label for="experience"><b>Experience :</b></label>
									</div>
									<div class="col-md-8">
										<p><?php echo $row["experience_years"]. " Years"; ?></p>
									</div>
								</div>
								<div class="infogroup row">
									<div class="col-md-4">
										<label for="barnumber"><b>Bar Association Number :</b></label>
									</div>
									<div class="col-md-8">
										<p><?php echo $row["bar_association_number"]; ?></p>
									</div>
								</div>

								<div class="infogroup row">
									<div class="col-md-4">
										<label for="Other details"><b>Description :</b></label>
									</div>
									<div class="col-md-8">
										<p><?php echo $row["description"]; ?></p>
									</div>
								</div>

								<div class="row mt-4">
                                    <div class="col-md-12">
                                        <?php if(!isset($_SESSION['name'])) { ?>
                                            <button type="submit" class="lawyer btn btn-primary">Book Now</button>
                                        <?php } else { ?>
                                            <form action="" method="post" id="appointmentForm">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="lawyer_id" value="<?php echo $row['lawyer_id']; ?>">
                                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                                        <div class="form-group">
                                                            <label for="date"><strong>Date:</strong></label>
                                                            <input type="date" class="form-control" name="date" id="date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description"><strong>Description:</strong></label>
                                                            <textarea class="form-control" name="description" id="description" cols="20" rows="4" placeholder="Write description if any"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-3 text-end">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>

							</div>
						</div>
						<?php
						}
					}
				}
					?>
				</div>
			</div>
</section>
