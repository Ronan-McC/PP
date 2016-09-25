<?php // login_functions
	function redirect_user($page = 'index.php') {
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
		$url = rtrim($url, '/\\');
		$url .= '/' . $page;

		header("Location: $url");
		exit();
	}

	function check_login($dbc, $user, $pass) {
		# user and pass not empty, due to javascript
		$u = mysqli_real_escape_string($dbc, trim($user));
		$p = mysqli_real_escape_string($dbc, trim($pass));

		$q = "SELECT id, firstname FROM users WHERE username='$u' 
		AND password=SHA1('$p')";
		$r = mysqli_query($dbc, $q);

		//check result
		if(mysqli_num_rows($r) == 1) {
			$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
			return array(true, $row);
		} else {
			$errors = "The username and password do not match";
		}

		return array(false, $errors);
	}
?>