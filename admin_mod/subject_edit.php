<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Subject</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>Edit Subject</h2>
							</div>
							<div class="panel-content-norm">
								<span class="error" id="error"></span>
								<form class="enter-data" method="post" id="editSubject">
									<div>
										<label class="data-name">Subject Code:</label>
										<input type="text" value="<?php echo $scode; ?>" id="subCode" disabled required>
									</div>
									<div>
										<label class="data-name">Subject Title:</label>
										<input type="text" value="<?php echo $title; ?>" id="title" required>
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
		<script type="text/javascript">document.getElementById('editSubject').addEventListener('submit', editSubject);</script>
<?php include '../assets/includes/footer.php'; ?>