<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Dashboard</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel dash back-color-maroon">
							<h2>Student Registered</h2>
							<h1><?php $el->getStudentsRegistered(); ?></h1>
						</div>
						<div class="panel dash back-color-maroon">
							<h2>Teacher Registered</h2>
							<h1><?php $el->getTeachersRegistered(); ?></h1>
						</div>
						<div class="panel dash back-color-maroon">
							<h2>Classes</h2>
							<h1><?php $el->getClassNum(); ?></h1>
						</div>
						<div class="panel dash back-color-maroon">
							<h2>School-Year</h2>
							<h1><?php echo $el->getSchoolYear(); ?></h1>
						</div>
					</div>
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header">
								<h2>User Logs</h2>
							</div>
							<div class="panel-content">
								<table class="view-table" id="classTable">
									<?php echo $el->getLatestUserLogs() ?>
								</table>
							</div>
						</div>
						<div class="panel back-color-white">
							<div class="panel-header">
								<h2>Activity Logs</h2>
							</div>
							<div class="panel-content">
								<table class="view-table" id="classTable small-font">
									<?php echo $el->getLatestActivityLogs() ?>
								</table>
							</div>
						</div>
					</div>
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header">
								<h2>Announcement</h2>
							</div>
							<div class="panel-content">
								<table class="view-table" id="classTable">
									<?php echo $el->getLatestAnnounce() ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->

<?php include '../assets/includes/footer.php'; ?>