<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Classes</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>New Student</h2>
							</div>
							<div class="panel-content-norm">
								<span class="error" id="error"></span>
								<form class="enter-data" method="post" id="setStudent">
									<div>
										<label class="data-name">Student ID:</label>
										<input type="text" id="studentID" required>
									</div>
									<div>
										<label class="data-name">First Name:</label>
										<input type="text" id="firstName" required>
									</div>
									<div>
										<label class="data-name">Last Name:</label>
										<input type="text" id="lastName" required>
									</div>
									<div>
										<label class="data-name">Course:</label>
										<input type="text" id="course" required>
									</div>
									<div>
										<label class="data-name">Password:</label>
										<input type="password" id="password" required>
									</div>
									<div>
										<label class="data-name">Confirm Password:</label>
										<input type="password" id="confirmPassword" required>
									</div>
									<div class="col-btn">
										<button class="button back-color-green">Create</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('setStudent').addEventListener('submit', setStudent);</script>
<?php include '../assets/includes/footer.php'; ?>