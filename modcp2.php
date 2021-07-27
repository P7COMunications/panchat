<?php
include 'config_auth.php';
if(file_exists($filedbbanick)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedbbanick, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fclose($fop);
}
if(file_exists($filedbbanicklist)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedbbanicklist, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fclose($fop);
}
if(isset($_COOKIE['username'])) {
	if(isset($_COOKIE['passwd'])) {
		if($_COOKIE['username'] == $u1a && $_COOKIE['passwd'] == base64_encode(md5($u1b))) {
			echo "<html><head><title>ModCP - Panchat</title></head><body><fieldset><legend>Welcome, $u1a - <a href='logout.php'>Logout</a></legend>";
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
if(isset($_POST['nickban'])) {
	$data03 = $_POST['nickban'];
	$filen01 = $filedbbanick;
	$data04 = "if($"."author == '".$data03."') { header('Location: warnban.php?type=3'); die;}";
	$action02 = fopen($filen01, "a");
	fwrite($action02, $data04);
	fwrite($action02, "\r\n");
	fclose($action02);
	$filecache01 = $filedbbanicklist;
	$datacache01 = "echo '<li>".$data03."</li>';";
	$cacheaction01 = fopen($filecache01, "a");
	fwrite($cacheaction01, $datacache01);
	fwrite($cacheaction01, "\r\n");
	fclose($cacheaction01);
}
?>
<form action="modcp2.php" method="POST">
<p>Ban nick: </p><input type="text" name="nickban" value="Nickname"/></p>
<p>Banned Nicknames: </p>
<p><ul><?php include ($filedbbanicklist); ?></ul></p>
<ul><p>More actions:
<li><a href="clsbanick.php">Clear Banned nicknames</a></li>
<li><a href="modcp.php">Go to ban messages of an IP</a></li>
<li><a href="modcp1.php">Go to ban "Clear Chat" function to an IP</a></li>
<li><a href="modcp3.php">Allow an IP the clearchat function</a></li>
</ul></p>
<input type="submit" value="Submit"/>
</form>
</body>
</html>