<?php include '../assets/includes/header.php'; ?>
<?php $id = $_GET['id']; ?>
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Anouncement</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>Edit Annocuncement</h2>
							</div>
							<div class="panel-content-norm">
								<span class="error" id="error"></span>
								<form class="enter-announce" method="post" id="editAnnounce">
									<div>
										<label class="data-name">Title:</label>
										<input type="text" value="<?php echo $title; ?>" id="title" required>
									</div>
									<div>
										<label class="data-name">Content:</label>
										<textarea rows="10" cols="80" id="content" required><?php echo $content; ?></textarea>
									</div>
									<input type="text" value="<?php echo $id ?>" id="classes" hidden required>
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
		<script type="text/javascript">document.getElementById('editAnnounce').addEventListener('submit', editAnnounce);</script>
<?php include '../assets/includes/footer.php'; ?>