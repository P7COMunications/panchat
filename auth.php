<?php
include 'config_auth.php';
if(isset($_POST['usr'])) {
	if(isset($_POST['psw'])) {
		$username = $_POST['usr'];
		$password = $_POST['psw'];
		if($u1a == $username && $u1b == $password) {
			$enc1p = base64_encode(md5($u1b));
			setcookie('username', $u1a, time()+3600);
			setcookie('passwd', $enc1p, time()+3600);
			header("Location: modcp.php");
			} else {
				header("Location: error.html");
				die;
			}
	} else {
		header("Location: error.html");
		die;
	}
} else {
	header("Location: error.html");
	die;
}
?>