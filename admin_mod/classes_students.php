<?php include '../assets/includes/header.php'; ?>
			<?php $id = $_GET['id']; ?>
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
								<h2>Students of Class <?php $el->getClassName($id); ?></h2>
								<a href="classes_addstudent.php?id=<?php echo $id; ?>"><button class="button-header back-color-green">Add Student</button></a>
							</div>
							<div class="panel-content-norm">
								<table class="action-table" id="classTable">
									<tr>
										<th>Student ID</th>
										<th>Student Name</th>
										<th>Course</th>
										<th>Action</th>
									</tr>
									<?php $el->getClassStudents($id); ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
<?php include '../assets/includes/footer.php'; ?>