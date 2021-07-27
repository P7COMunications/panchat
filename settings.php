<?php
if(isset($_POST['autoload'])) {
	setcookie('autoload5', $_POST['autoload'], time()+36000);
}
?>
<html>
<head>
<title>Settings - Panchat</title>
</head>
<body>
<fieldset>
<legend>Settings</legend>
<form action="settings.php" method="POST">
<p>Auto-Load5: <input type="radio" name="autoload" value="1"/> Enable <input type="radio" name="autoload" value="2"/> Disable
<p><input type="submit" value="Submit"/></p>
<p><a href="index.php">Back to home</a></p>
</form>
</fieldset>
</body>
</html>