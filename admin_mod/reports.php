<?php include '../assets/includes/header.php'; ?>
			
			<!-- DIRECTORY -->
			<div class="main-dir">
				<h1>Reports</h1>
			</div>
			<!-- END DIRECTORY -->
			
			<!-- CONTAINER -->
			<div class="main-container">
				<div class="inner-container">
					<div class="content-row">
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>Activity Logs<h2>
								<br>
								<form id="viewAL" method="post">
								<span class="date-text">Start</span> <input type="date" id="startDate"> &nbsp <span class="date-text">End</span> <input type="date" id="endDate">
								<button name="show" class="button-header back-color-blue">Show</button>
								</form>
							</div>
							<div class="panel-content-norm">
								<table class="view-table" id="classTable">
									<?php $el->getActivityLogs(); ?>
								</table>
							</div>
						</div>
						<div class="panel back-color-white">
							<div class="panel-header-norm">
								<h2>User Logs<h2>
								<br>
								<form id="viewUL" method="post">
								<span class="date-text">Start</span> <input type="date" id="startDate"> &nbsp <span class="date-text">End</span> <input type="date" id="endDate">
								<button name="show" class="button-header back-color-blue">Show</button>
								</form>
							</div>
							<div class="panel-content-norm">
								<table class="view-table" id="classTable">
									<?php $el->getUserLogs(); ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->

<?php include '../assets/includes/footer.php'; ?>