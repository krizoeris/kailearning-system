<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Users</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>Users List</h2>
								<a href="users_add.php"><button class="button-header back-color-rb">New User</button></a>
							</div>
							<div class="panel-content-norm">
								<table class="action-table" id="classTable">
									<tr>
										<th>User ID</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
									<?php $el->getUsersAd(); ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
<?php include '../assets/includes/footer.php'; ?>