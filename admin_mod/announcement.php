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
								<h2>Announcements</h2>
								<a href="announcement_add.php"><button class="button-header back-color-green">Post Announcement</button></a>
							</div>
							<div class="panel-content-norm">
								<table class="view-table" id="classTable">
									<tr>
										<th>Title</th>
										<th>Posted</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
									<?php $el->getAnnounceAd(); ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
<?php include '../assets/includes/footer.php'; ?>