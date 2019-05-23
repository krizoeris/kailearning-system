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
								<h2>Create Class</h2>
							</div>
							<div class="panel-content-norm">
								<span class="error" id="error"></span>
								<form class="enter-data" method="post" id="setClass">
									<div>
										<label class="data-name">Class Code:</label>
										<input type="text" disabled id="className">
									</div>
									<div>
										<label class="data-name">Subject: </label>
										<select id="selectSubject" onchange="getClassValue()" required>
											<option value="">--Select Subject--</option>
											<?php $el->getSubjectSelect();?>
										</select>
									</div>
									<div>
										<label class="data-name">Faculty: </label>
										<select id="selectFaculty" onchange="getClassValue()" required>
											<option value="">--Select Teacher--</option>
											<?php $el->getFacultySelect();?>
										</select>
									</div>
									<div>
										<label class="data-name">School Year: </label>
										<select id="selectSY" onchange="getClassValue()" required>
											<?php $el->getSYSelect();?>
										</select>
									</div>
									<div class="col-btn">
										<button class="button back-color-green">Create Class</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('setClass').addEventListener('submit', setClass);</script>
<?php include '../assets/includes/footer.php'; ?>