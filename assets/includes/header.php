<?php
include_once '../class/elearning.condition.php'; 

$el = new kailearning();


$url = $_SERVER['PHP_SELF'];
$urlArr = explode("/", $url);
$urlName = $urlArr[3];

$userName = $el->loggedIn($user, $type);

?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-learning System</title>
	<link rel="stylesheet" type="text/css" href="../assets/styles/elearning.private.css?<?php echo time(); ?>">
</head>
<body>
	<!-- DASHBOARD WRAPPER -->
	<div class="dash-wrapper">
	
		<!-- SIDEBAR -->
		<div class="sidebar">
			<div class="sidebar-header">
				<h3>E-Learning System</h3>
			</div>
			<div class="sidebar-nav">
			<?php if($type == '0'){ ?>
				<ul class="nav-links">
					<li><a href="index.php" class="<?php if($urlName == 'index.php'){echo 'active-link';} ?>">Dashboard</a></li>
					<li><a href="classes.php" class="<?php if($urlName == 'classes.php'){echo 'active-link';} ?>">Classes</a></li>
					<li><a href="student.php" class="<?php if($urlName == 'student.php'){echo 'active-link';} ?>">Student</a></li>
					<li><a href="faculty.php" class="<?php if($urlName == 'faculty.php'){echo 'active-link';} ?>">Faculty</a></li>
					<li><a href="subject.php" class="<?php if($urlName == 'subject.php'){echo 'active-link';} ?>">Subject</a></li>
					<li><a href="users.php" class="<?php if($urlName == 'users.php'){echo 'active-link';} ?>">Users</a></li>
					<li><a href="reports.php" class="<?php if($urlName == 'reports.php'){echo 'active-link';} ?>">Reports</a></li>
					<li><a href="school_year.php" class="<?php if($urlName == 'school_year.php'){echo 'active-link';} ?>">School Year</a></li>
					<li><a href="announcement.php" class="<?php if($urlName == 'announcement.php'){echo 'active-link';} ?>">Announcements</a></li>
				</ul>
			<?php } ?>
			<?php if($type == '1'){ ?>
				<ul class="nav-links">
					<li><a href="index.php" class="<?php if($urlName == 'index.php'){echo 'active-link';} ?>">Home</a></li>
					<li><a href="classes.php" class="<?php if($urlName == 'classes.php'){echo 'active-link';} ?>">My Class</a></li>
					<li><a href="assignment_add.php" class="<?php if($urlName == 'assignment_add.php'){echo 'active-link';} ?>">Upload Assignment</a></li>
					<!--<li><a href="quiz.php" class="<?php //if($urlName == 'quiz.php'){echo 'active-link';} ?>">Manage Quiz</a></li>-->
					<li><a href="annocement.php" class="<?php if($urlName == 'announcement.php'){echo 'active-link';} ?>">Post Announcement</a></li>
				</ul>
			<?php } ?>
			<?php if($type == '2'){ ?>
				<ul class="nav-links">
					<li><a href="index.php" class="<?php if($urlName == 'index.php'){echo 'active-link';} ?>">Home</a></li>
					<li><a href="classes.php" class="<?php if($urlName == 'classes.php'){echo 'active-link';} ?>">My Class</a></li>
				</ul>
			<?php } ?>
			</div>
		</div>
		<!-- SIDEBAR -->
		
		<!-- CONTENT -->
		<div class="main-content">

		<!-- NAV -->
			<div class="main-nav">
				<div class="nav-dropdown">
					<a href="#"><?php echo ucwords($userName); ?> <span class="arrow-dropdown">&#9662;</span></a>
					<ul class="nav-dropdown-content">
						<li>
						<?php if($type == '0'){ ?>
							<a href="profile.php?id=<?php echo $user; ?>&action=select-user">Profile</a>
						<?php } ?>
						<?php if($type == '2'){ ?>
							<a href="profile.php?id=<?php echo $user; ?>&action=select-student">Profile</a>
						<?php } ?>
						<?php if($type == '1'){ ?>
							<a href="profile.php?id=<?php echo $user; ?>&action=select-faculty">Profile</a>
						<?php } ?>
						</li>
						<li><a href="../logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
			<!-- END NAV -->