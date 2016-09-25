<?php
	session_start();
	if(!isset($_SESSION['name'])) {
		header('Location: http://www.properpunting.com/user/login.php');
	}
?>
<?php
	include('./includes/externs.html');
?>
	</head>

	<body>
		<?php include('./includes/header.html'); ?>
	</body>
</html>