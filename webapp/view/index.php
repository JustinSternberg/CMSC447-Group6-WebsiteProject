<?php
	require_once(dirname(__FILE__) . '/../load.php');
	session_start();
	$db = new DB();
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login page</title>

		<!-- AJAX Prototype Import -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">jQuery.noConflict();</script>
		<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>

		<!-- Import datatables
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />-->

		<!--Bootstrap CSS & JS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<!--  Custom CSS & JS -->
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<script src="js/ajax.js"></script>
		<script src="js/libs.js"></script>
		<script src="js/bootbox.min.js"></script>
		<script type="text/javascript">
			//var JQ = $.noConflict(); //Need JQUERY.NOCONFLICT();  Otherwise prototypes methods will be overwritten
			jQuery(function ($) {
				// The dollar sign will equal jQuery in this scope

			});

		</script>
		<link type="text/css" rel="stylesheet" href="styles/styles.css" />
	</head>
	<body>
		<div id="container">

			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog" style="height:auto;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="appTitle"></h4>
						</div>
						<div class="modal-body">
							<div id="writeID">
								<!-- Application content goes here -->
								Please log in:
								<form action="submit.php" method="POST">
									<label>Username:<input type="text" name="campusID" /></label><br>
									<label>Password:<input type="password" name="password" /></label><br>
									<button type="submit" value="Submit">Login</button><br>
								</form>
								<!--Form goes here -->
								Not a member?  Sign up here<br>
								<!--Another form -->
								<form action="register.php" method="POST">
									<label>Username:<input type="text" name="campusID" /></label><br>
									<label>Password:<input type="password" name="password" /></label><br>
									<button type="submit">Register</button><br>
								</form>
							</div>
						</div>
						<div class="modal-footer">

						</div>
					</div>
				</div>
			</div>
			<!-- !Modal -->
			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">View</button>
		</div>
	</body>

</html>
