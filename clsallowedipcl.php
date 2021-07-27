<?php
include 'config_auth.php';
if(isset($lockclschat)) {
	if($lockclschat == "disable") {
			echo "<fieldset><legend>Disabled</legend><p>This feature is disabled on config_auth.php</p><p><a href='modcp.php'>Go Back</a></p>";
			die;
	}
} else {
	echo "<fieldset><legend>Disabled</legend><p>This feature is disabled on config_auth.php</p><p><a href='modcp.php'>Go Back</a></p>";
	die;
}
if(file_exists($filedballowedipcl)) {
	$dummy_var = "1234";
} else {
	$fop = fopen($filedballowedipcl, "a");
	fwrite($fop, "<?php");
	fwrite($fop, "\r\n");
	fwrite($fop, "if($"."srvloc == '::1') { dbclsp(); header('Location: index.php'); } else { header('Location: warnban.php?type=4'); }");
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
			$archivo = $filedballowedipcl;
			unlink($archivo);
			$a1 = fopen($archivo, "a");
			fwrite($a1, "<?php");
			fwrite($a1, "\r\n");
			fclose($a1);
			$archivocache = $filedballowedipclist;
			unlink ($archivocache);
			$a1cache = fopen($archivocache, "a");
			fwrite($a1cache, "<?php");
			fwrite($a1cache, "\r\n");
			fclose($a1cache);
			header("Location: modcp3.php");
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
}
?>