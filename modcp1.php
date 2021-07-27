<?php
include 'config_auth.php';
if(file_exists($filedbcls)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedbcls, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fclose($fop);
}
if(file_exists($filedbclslist)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedbclslist, "a");
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
if(isset($_POST['clearban'])) {
	$data3 = $_POST['clearban'];
	$filen1 = $filedbcls;
	$data4 = "if($"."srvloc == '".$data3."') { header('Location: warnban.php?type=2'); die;}";
	$action2 = fopen($filen1, "a");
	fwrite($action2, $data4);
	fwrite($action2, "\r\n");
	fclose($action2);
	$filecache1 = $filedbclslist;
	$datacache1 = "echo '<li>".$data3."</li>';";
	$cacheaction1 = fopen($filecache1, "a");
	fwrite($cacheaction1, $datacache1);
	fwrite($cacheaction1, "\r\n");
	fclose($cacheaction1);
}
?>
<form action="modcp1.php" method="POST">
<p>Ban "Clear chat" to IP: </p><input type="text" name="clearban" value="0.0.0.0"/></p>
<p>Banned IPS: </p>
<p><ul><?php include ($filedbclslist); ?></ul></p>
<p><ul>More actions:
<li><a href="clsbanmsjc.php">Clean IP list of banned function "Clear Chat"</a></li>
<li><a href="modcp.php">Go to ban messages of an IP</a></li>
<li><a href="modcp2.php">Ban nicknames</a></li>
<li><a href="modcp3.php">Allow an IP the clearchat function</a></li>
</ul></p>
<input type="submit" value="Submit"/>
</form>
</body>
</html>