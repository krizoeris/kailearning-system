<?php include '../assets/includes/header.php'; ?>
			<?php $cid = $_GET['id']; ?>
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
								<h2>Student Lists
								<a href="students.php?id=<?php echo $cid; ?>"><button class="button-header back-color-blue">Back</button></a></h2>
							</div>
							<div class="panel-content-norm">
								<table class="action-table" id="classTable">
									<tr>
										<th>Student ID</th>
										<th>Student Name</th>
										<th>Course</th>
										<th>Action</th>
									</tr>
									<?php $el->getStudentsTeacher($cid); ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
<?php include '../assets/includes/footer.php'; ?>