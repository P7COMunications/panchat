<?php
include 'config_auth.php';
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
if($lockclschat == 'enable') {
	function dbclsp() {
		include 'config_auth.php';
		$archivo = $filedb;
		unlink($archivo);
		$a1 = fopen($archivo, "a");
		fwrite($a1, "<?php");
		fwrite($a1, "\r\n");
		fclose($a1);
	}
	$srvloc = $_SERVER['REMOTE_ADDR'];
	include ($filedballowedipcl);
	//header('Location: index.php');
} else {
	$srvloc = $_SERVER['REMOTE_ADDR'];
	include ($filedbcls);
	$archivo = $filedb;
	unlink($archivo);
	$a1 = fopen($archivo, "a");
	fwrite($a1, "<?php");
	fwrite($a1, "\r\n");
	fclose($a1);
	header("Location: index.php");
}
?>