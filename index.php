<?php
include 'config_auth.php';
if(file_exists($filedb)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedb, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fclose($fop);
}
?>
<html>
<head>
<title>Home - Panchat</title>
<meta http-equiv="refresh" content="<?php if(isset($_COOKIE['autoload5'])) { if($_COOKIE['autoload5'] == 1) { echo $timeoutal5; } if($_COOKIE['autoload5'] == 2) { echo " "; } } else { echo " "; } ?>"/>
</head>
<body>
<form action="exec.php" method="POST">
<fieldset>
<legend>Chat</legend>
<?php
include $filedb;
?>
<p><b>Nick: </b><input type="text" name="author" value="<?php if(isset($_COOKIE['author'])) { echo $_COOKIE['author'];} else { echo "NULL";} ?>"/></p>
<p><b>Message: </b><input type="text" name="data" value=""/><input type="submit" value="Send"/></p>
<p><a href="delete.php">Delete chat</a> | <a href="login.php">Mod Panel</a> | <a href="settings.php">Settings</a> | <a href="about.html">About</a>
</fieldset>
</form>
</body>
</html>