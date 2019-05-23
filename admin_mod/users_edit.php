<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Users</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>Edit User</h2>
							</div>
							<div class="panel-content-norm">
								<span class="error" id="error"></span>
								<form class="enter-data" method="post" id="editUser">
									<div>
										<label class="data-name">User ID:</label>
										<input type="text" value="<?php echo $id; ?>" id="userID" disabled required>
									</div>
									<div>
										<label class="data-name">First Name:</label>
										<input type="text" value="<?php echo $fname; ?>" id="fname" required>
									</div>
									<div>
										<label class="data-name">Last Name:</label>
										<input type="text" value="<?php echo $lname; ?>" id="lname" required>
									</div>
									<div>
										<label class="data-name">Password:</label>
										<input type="password" value="<?php echo $password; ?>" id="pass" required>
									</div>
									<div>
										<label class="data-name">Confirm Password:</label>
										<input type="password" value="<?php echo $password; ?>" id="cpass" required>
									</div>
									<div class="col-btn">
										<button class="button back-color-green">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('editUser').addEventListener('submit', editUser);</script>
<?php include '../assets/includes/footer.php'; ?>