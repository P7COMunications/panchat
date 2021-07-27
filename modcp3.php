<?php
include 'config_auth.php';
if(isset($lockclschat)) {
	if($lockclschat == 'disable') {
			echo "<title>Disabled</title><fieldset><legend>Disabled</legend><p>This feature is disabled on config_auth.php</p><p><a href='modcp.php'>Go Back</a></p>";
			die;
	}
} else {
	echo "<title>Disabled</title><fieldset><legend>Disabled</legend><p>This feature is disabled on config_auth.php</p><p><a href='modcp.php'>Go Back</a></p>";
	die;
}
if(file_exists($filedballowedipcl)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedballowedipcl, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fclose($fop);
}
if(file_exists($filedballowedipclist)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedballowedipclist, "a");
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
if(isset($_POST['allowip'])) {
	$data003 = $_POST['allowip'];
	$filen001 = $filedballowedipcl;
	$data004 = "if($"."srvloc == '".$data003."') { dbclsp(); header('Location: index.php'); } else { header('Location: warnban.php?type=4'); }";
	$action002 = fopen($filen001, "a");
	fwrite($action002, $data004);
	fwrite($action002, "\r\n");
	fclose($action002);
	$filecache001 = $filedballowedipclist;
	$datacache001 = "echo '<li>".$data003."</li>';";
	$cacheaction001 = fopen($filecache001, "a");
	fwrite($cacheaction001, $datacache001);
	fwrite($cacheaction001, "\r\n");
	fclose($cacheaction001);
}
?>
<form action="modcp3.php" method="POST">
<p>Allow CLSDB to IP: </p><input type="text" name="allowip" value="0.0.0.0"/></p>
<p>Allowed IPs: </p>
<p><ul><?php include ($filedballowedipclist); ?></ul></p>
<p><ul>More Actions:
<li><a href="clsallowedipcl.php">Clear allowed IPs</a></li>
<li><a href="modcp.php">Go to ban messages of an IP</a></li>
<li><a href="modcp1.php">Go to ban "Clear Chat" function to an IP</a></li>
<li><a href="modcp2.php">Go to ban Nicknames</a></li>
</ul></p>
<input type="submit" value="Submit"/>
</form>
</body>
</html>