<?php
include 'config_auth.php';
setcookie('username', $u1a, time()-650000);
setcookie('passwd', $u1b, time()-650000);
?>
<fieldset>
<legend>Logout</legend>
<p>Sucessfully logged out.</p>
<p><a href="login.php">Go Back</a></p>
</fieldset>