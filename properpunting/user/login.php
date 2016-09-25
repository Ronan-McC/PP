<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		require('../includes/login_functions.php');
		require('../../properpunting_mysql_connect.php');
		list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['password']);

		if($check) {
			session_start();
			$_SESSION['id'] = $data['id'];
			$_SESSION['name'] = $data['firstname'];
			redirect_user('../index.php');
		} else {
			$errors = $data;
		}
	}

?>

<?php
	$page_title = "Login";
	include('../includes/externs.html');
?>
		<link rel="stylesheet" href="../css/login.css">
	</head>

	<body>
		<?php
			if(isset($errors)) {
				echo "<div class='alert alert-danger'>";
				echo "<strong>Error!</strong> $errors</div>";
			}
		?>
		
		<div id="center-area">
			<img src="../images/logo.png" alt="logo">
			<h1 id="title-text">Proper Punting</h1>
			<form method="post" action="login.php">
				<div class="form-group">
					<label for="username">User:</label>
					<input id="user" type="text" class="form-control" name="username" size="25" 
					placeholder="Enter username" maxlength="20">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input id="pass" type="password" class="form-control" name="password" size="25" 
					placeholder="Enter password" maxlength="20">
				</div>
				<button id="form-button" type="button" class="btn btn-default">Submit</button>
			</form>
		</div>

		<script>
			$(function() {
				var b = document.getElementById('form-button');
				b.addEventListener('click', function() {
					var user = document.getElementById('user').value;
					var pass = document.getElementById('pass').value;

					if(user.length === 0) {
						alert('Please enter a username');
						return;
					}
					else if(pass.length === 0) {
						alert('Please enter a password');
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
	</body>
</html>