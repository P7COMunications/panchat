<?php
include 'config_auth.php';
if(file_exists($filedbbanmsj)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedbbanmsj, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fclose($fop);
}
if(file_exists($filedbbanmsjlist)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedbbanmsjlist, "a");
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
if(isset($_POST['msjban'])) {
	$data1 = $_POST['msjban'];
	$filen = $filedbbanmsj;
	$data2 = "if($"."srvloc == '".$data1."') { header('Location: warnban.php?type=1'); die;}";
	$action1 = fopen($filen, "a");
	fwrite($action1, $data2);
	fwrite($action1, "\r\n");
	fclose($action1);
	$filecache1 = $filedbbanmsjlist;
	$datacache1 = "echo '<li>".$data1."</li>';";
	$cacheaction1 = fopen($filecache1, "a");
	fwrite($cacheaction1, $datacache1);
	fwrite($cacheaction1, "\r\n");
	fclose($cacheaction1);
}
?>
<form action="modcp.php" method="POST">
<p>Ban messages to IP: </p><input type="text" name="msjban" value="0.0.0.0"/></p>
<p>Banned IPS: </p>
<p><ul><?php include ($filedbbanmsjlist); ?></ul></p>
<p><ul>More actions:
<li><a href="clsbanmsj.php">Clean IP banned messages list</a></li> 
<li><a href="modcp1.php">Go to ban "Clear Chat" function to an IP</a></li>
<li><a href="modcp2.php">Ban nicknames</a></li>
<li><a href="modcp3.php">Allow an IP the clearchat function</a></li>
</ul></p>
<input type="submit" value="Submit"/>
</form>
</body>
</html>