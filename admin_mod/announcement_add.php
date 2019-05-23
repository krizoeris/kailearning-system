<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Announcement</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>New Announcement</h2>
							</div>
							<div class="panel-content-norm">
								<span class="error" id="error"></span>
								<form class="enter-announce" method="post" id="setAnnounce">
									<div>
										<label class="data-name">Title:</label>
										<input type="text" id="title" required>
									</div>
									<div>
										<label class="data-name">Content:</label>
										<textarea rows="10" cols="80" id="content" required></textarea>
									</div>
									<input type="text" value="All" id="classes" hidden required>
									<div class="col-btn">
										<button class="button back-color-green">Post</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('setAnnounce').addEventListener('submit', setAnnounce);</script>
<?php include '../assets/includes/footer.php'; ?>