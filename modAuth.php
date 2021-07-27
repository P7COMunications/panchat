<?php
/*
 * /=======================================================\
 * | Panchat v2.0.0                                        |
 * | Copyright (c) P7COMunications LLC 2021 - PANCHO7532   |
 * |=======================================================/
 * |-> Purpose: Moderation Authorization System
 * ---------------------------------------------------------
 */
include 'config.inc.php';
function xorCrypto($key, $data) {
    $result = "";
    for($a = 0, $b = 0; $a < strlen($data); $a++, $b++) {
        if($b >= strlen($key)) { $b = 0; }
        $result .= $data{$a} ^ $key{$b};
    }
    return $result;
}
if(isset($_GET['logout']) && $_GET["logout"] == 1) {
    if(isset($_COOKIE["username"])) {
        setcookie('username', "NULL", time()-650000);
    } else if(isset($_COOKIE["passwd"])) {
        setcookie('passwd', "NULL", time()-650000);
    }
    echo '<!DOCTYPE html><html><head><title>Logout - Panchat</title></head><body><fieldset><legend>Logout</legend><p>Sucessfully logged out.</p><p><a href="modAuth.php">Go Back</a></p></fieldset></body></html>';
    die;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // start auth xd
    if(isset($_POST['usr']) && isset($_POST['psw'])) {
        $username = htmlspecialchars($_POST['usr']);
        $password = htmlspecialchars($_POST['psw']);
        if($u1a == $username && $u1b == $password) {
            $enc1u = md5(base64_encode(xorCrypto($xorKey, $username)));
            $enc1p = md5(base64_encode(xorCrypto($xorKey, $u1b)));
            setcookie('username', $enc1u, time()+3600);
            setcookie('passwd', $enc1p, time()+3600);
            header("Location: modcp.php");
        } else {
            header("Location: error.html");
            die;
        }
    } else {
        header("Location: error.html");
        die;
    }
} else {
    // if we have actual valid cookies then why not redirect to the moderation panel
    // Actually htmlspecialchars() might damage this one so idk
    if(isset($_COOKIE['username']) && isset($_COOKIE['passwd'])) {
        $username = htmlspecialchars($_COOKIE['username']);
        $password = htmlspecialchars($_COOKIE['passwd']);
        if(md5(base64_encode(xorCrypto($xorKey, $u1a))) == $username && md5(base64_encode(xorCrypto($xorKey, $u1b))) == $password) {
            header("Location: modcp.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login - Panchat</title>
    </head>
    <body>
        <fieldset>
            <legend>Login</legend>
            <form action="modAuth.php" method="POST">
                <p>Username: <input type="text" name="usr" value=""/></p>
                <p>Password: <input type="password" name="psw" value=""/></p>
                <input type="submit" value="Login"/>
                <p><a href="index.php">Back to home</a>
            </form>
        </fieldset>
    </body>
</html>