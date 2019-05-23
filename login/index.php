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
		<title>E-learning System</title>
		<link rel="stylesheet" type="text/css" href="../assets/styles/elearning.public.css?<?php echo time(); ?>">
	</head>
	<body>
		<!-- LOGIN -->
		<div style="padding-top:20vh">
			<div class="login-container">
				<!-- LOGIN HEADER -->
				<div class="login-header">
					<span class="login-header-title"><h1>E-learning System</h1></span>
				</div>
				<!-- LOGIN CONTENT -->
				<div class="login-content">
					<span class="error" id="error"></span>
					<form method="post" id="loginForm" class="login-form">
						<div class="login-form-group">
							<label>UserID</label>
							<input type="text" name="userid" value="admin" class="form-input" id="userid" placeholder="StudentID or FacultyID..." REQUIRED>
						</div>
						<div class="login-form-group">
							<label>Password</label>
							<input type="password" name="password" value="admin" class="form-input" id="password" placeholder="Password..." REQUIRED>
						</div>
						<div class="login-button">
							<button type="login" name="login" class="button button5">Login</button>
						</div>
					</form>
				<div>
				<div class="login-footer">
					Dont have an account? <a href="register-student.php">Register as Student</a> Or <a href="register-teacher.php">Register as Teacher</a>
					<br><br>
					Username: admin | Password: admin
				</div>
			</div>
		</div>
		
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('loginForm').addEventListener('submit', setCredentials);</script>
	</body>
</html>