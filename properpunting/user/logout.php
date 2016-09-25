<?php
	session_start();
	require('../includes/login_functions.php');

	if(isset($_SESSION['name'])) {
		$_SESSION = array(); // clear session variables
		session_destroy(); // destroy session
		setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0); // destroy cookie
	}

	redirect_user('../index.php');
?>