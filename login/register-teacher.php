<!--
	Title: E-learning System 
	Developer: Kriztian Eris E. Labatete 
	Version: 1.2
//-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>KaiLearning</title>
		<link rel="stylesheet" type="text/css" href="../assets/styles/elearning.public.css?<?php echo time(); ?>">
	</head>
	<body>
		<!-- REGISTER -->
		<div style="padding-top:5%">
		<div class="register-container">
			<!-- REGISTER HEADER -->
			<div class="register-header">
				<span class="register-header-title"><h1>KaiLearning System</h1></span>
				<span class="register-header-subtitle">Faculty Registration</span>
			</div>
			<!-- REGISTER CONTENT -->
			<div class="register-content">
				<span class="error" id="error"></span>
				<form method="post" id="register-faculty" class="register-form">
					<div class="register-form-group">
						<label>UserID</label>
						<input type="text" name="userid" class="form-input" id="userid" placeholder="FacultyID..." required> 
					</div>
					<div class="register-form-group">
						<label>First Name</label>
						<input type="text" name="fname" class="form-input" id="fname" placeholder="First Name..." required>
					</div>
					<div class="register-form-group">
						<label>Last Name</label>
						<input type="text" name="lname" class="form-input" id="lname" placeholder="Last Name..." required>
					</div>
					<div class="register-form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-input" id="password" placeholder="Password..." required>
					</div>
					<div class="register-form-group">
						<label>Confirm Password</label>
						<input type="password" name="confirm-password" class="form-input" id="confirm-password" placeholder="Confirm Password..." required>
					</div>
					<div class="register-button">
						<button name="register-faculty" class="button button5">Register</button>
					</div>
				</form>
			<div>
			<!-- REGISTER FOOTER -->
			<div class="register-footer">
				Already had an account? <a href="index.php">Log in</a> 
			</div>
		</div>
		</div>
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('register-faculty').addEventListener('submit', setRegisterTeacher);</script>
	</body>
</html>