<?php include '../assets/includes/header.php'; ?>
			<?php $id = $_GET['cid']; ?>
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
								<h2><?php echo $title; ?> <a href="class.php?cid=<?php echo $id; ?>"><button class="button-header back-color-blue">Back</button></a></h2>
							</div>
							<div class="panel-content-norm">
								<p><?php echo $content; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
		<script src="../assets/javascript/elearning.scripts.js?<?php echo time(); ?>"></script>
		<script type="text/javascript">document.getElementById('setAnnounce').addEventListener('submit', setAnnounce);</script>
<?php include '../assets/includes/footer.php'; ?>