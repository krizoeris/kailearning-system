<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>School Year <?php echo $el->getSchoolYear(); ?></h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>School Year List </h2>
								Current School Year(<?php echo $el->getSchoolYear(); ?>)
								<a href="school_year_add.php"><button class="button-header back-color-rb">New School Year</button></a>
							</div>
							<div class="panel-content-norm">
								<table class="action-table" id="classTable">
									<tr>
										<th>School Year</th>
										<th>Created</th>
										<th>Action</th>
									</tr>
									<?php $el->getSYAd(); ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
<?php include '../assets/includes/footer.php'; ?>