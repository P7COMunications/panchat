<?php
if(isset($_GET['type'])) {
	if($_GET['type'] == 1) {
		echo "<title>ERROR</title><fieldset><legend>Warning</legend><p>ERROR: You are unable to send messages, contact to administrator for unban</p><p><a href='index.php'>Go Back</a></p></fieldset>";
	} elseif($_GET['type'] == 2) {
		echo "<title>ERROR</title><fieldset><legend>Warning</legend><p>ERROR: You are unable to clear the chat, contact to administrator for unban</p><p><a href='index.php'>Go Back</a></p></fieldset>";
	} elseif($_GET['type'] == 3) {
		echo "<title>ERROR</title><fieldset><legend>Warning</legend><p>ERROR: That nickname its banned, please choose a new one</p><p><a href='index.php'>Go Back</a></p></fieldset>";
	} elseif($_GET['type'] == 4) {
		echo "<title>ERROR</title><fieldset><legend>Warning</legend><p>ERROR: The clear chat function its locked for only allowed IPs, please contact to administrator for whitelist your IP for use that function</p><p><a href='index.php'>Go Back</a></p></fieldset>";
	} else {
		echo "<title>-1</title><html>-1</html>";
	}
} else {
	echo "<fieldset><legend>Warning</legend><p>What are you doing here? You dont maded anything wrong fot the moment!!!</p><a href='index.php'>Go Back</a></p></fieldset>";
}
?>