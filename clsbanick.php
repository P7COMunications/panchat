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
			$archivo = $filedbbanick;
			unlink($archivo);
			$a1 = fopen($archivo, "a");
			fwrite($a1, "<?php");
			fwrite($a1, "\r\n");
			fclose($a1);
			$archivocache = $filedbbanicklist;
			unlink ($archivocache);
			$a1cache = fopen($archivocache, "a");
			fwrite($a1cache, "<?php");
			fwrite($a1cache, "\r\n");
			fclose($a1cache);
			header("Location: modcp2.php");
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