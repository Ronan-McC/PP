<?php
	session_start();

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		require('../includes/login_functions.php');
		require('../../properpunting_mysql_connect.php');

		$new_pass = $_POST['password'];
		$q = "UPDATE users SET password=SHA1('$new_pass') WHERE id='" . $_SESSION['id'] . "';";
		$r = mysqli_query($dbc, $q);
	}
?>

<?php
	$page_title = "Account";
	include('../includes/externs.html');
?>
		<link rel="stylesheet" href="../css/login.css">
	</head>

	<body>
		<?php
			include('../includes/header.html');

			if(isset($r)) {
				if($r == TRUE) {
					echo "<div class='alert alert-success'><strong>Success!</strong> ";
					echo "Password successfully changed!</div>";
				} else {
					echo "<div class='alert alert-danger'><strong>Error!</strong> ";
					echo "Password was not changed, please try again.</div>";
				}
			}
		?>

		<div id="center-area">
			<form method="post" action="account.php">
				<div class="form-group">
					<label for="password">New password:</label>
					<input id="pass" type="password" class="form-control" name="password" size="25" 
					placeholder="Enter new password" maxlength="20">
				</div>
				<div class="form-group">
					<label for="password">Re-enter new password:</label>
					<input id="re-pass" type="password" class="form-control" name="re-password" size="25" 
					placeholder="Re-enter new password" maxlength="20">
				</div>
				<button id="form-button" type="button" class="btn btn-default">Submit</button>
			</form>

			<script>
			$(function() {
				var b = document.getElementById('form-button');
				b.addEventListener('click', function() {
					var pass = document.getElementById('pass').value;
					var repass = document.getElementById('re-pass').value;

					if(pass.length === 0) {
						alert('Please enter a new password');
						return;
					}
					else if(repass.length === 0) {
						alert('Please re-enter the new password');
						return;
					}
					else if(pass !== repass) {
						alert('You must re-enter the same password');
						return;
					}
					else {
						console.log(this);
						this.type = "submit";
						this.click();
					}
				});
			});
		</script>
		</div>
	</body>
</html>