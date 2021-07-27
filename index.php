<?php
/*
 * /=======================================================\
 * | Panchat v2.0.0                                        |
 * | Copyright (c) P7COMunications LLC 2021 - PANCHO7532   |
 * |=======================================================/
 * |-> Purpose: Index File
 * ---------------------------------------------------------
 */
include 'config.inc.php';
$dataModel = array(
    "messages" => array()
);
$moderationModel = array(
    "bannedNicknames" => array(),
    "bannedIPs" => array(),
    "allowedIPsCLS" => array()
);
function basicFileCheck($filedir, $filedb, $filemod, $dataModel, $moderationModel) {
    if(!file_exists($filedir)) {
        //checking if data folder exists for begin with
        mkdir($filedir);
    }
    if(!file_exists($filedb)) {
        //checking if message database exists
        $fileHandler = fopen($filedb, "w");
        fwrite($fileHandler, json_encode($dataModel));
        fclose($fileHandler);
    }
    if(!file_exists($filemod)) {
        $fileHandler = fopen($filemod, "w");
        fwrite($fileHandler, json_encode($moderationModel));
        fclose($fileHandler);
    }
}
function xorCrypto($key, $data) {
    $result = "";
    for($a = 0, $b = 0; $a < strlen($data); $a++, $b++) {
        if($b >= strlen($key)) { $b = 0; }
        $result .= $data{$a} ^ $key{$b};
    }
    return $result;
}
basicFileCheck($filedir, $filedb, $filemod, $dataModel, $moderationModel);
if(isset($_GET['clear']) && $_GET["clear"] == 1) {
    //mod stuff
    $clearLock = false;
    $tmpModData = json_decode(file_get_contents($filemod), true);
    if($lockclschat == "enable") {
        if(in_array(base64_encode(xorCrypto($xorKey, $_SERVER["REMOTE_ADDR"])), $tmpModData["allowedIPsCLS"])) {
            $clearLock = true;
        }
        if(!$clearLock) {
            echo "<!DOCTYPE html><html><head><title>ERROR</title></head><body><fieldset><legend>Locked</legend><p>ERROR: The clear chat function its locked for only allowed IPs, please contact the Administrator of this website for whitelist your IP and use this function</p><p><a href='index.php'>Go Back</a></p></fieldset></body></html>";
            die;
        } else {
            $fileHandler = fopen($filedb, "w");
            fwrite($fileHandler, json_encode($dataModel));
            fclose($fileHandler);
            header("Location: index.php");
        }
    } else {
        $fileHandler = fopen($filedb, "w");
        fwrite($fileHandler, json_encode($dataModel));
        fclose($fileHandler);
        header("Location: index.php");
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //its a post request (aka, a new message)
    if(isset($_POST["author"]) && isset($_POST["data"])) {
        $author = $_POST["author"];
		$data = $_POST["data"];
		setcookie('author', $author, time()+36000);
    } else {
        header("Location: index.php");
        die;
    }
    //uuh yeah, exceptions
    if($author == '' || $author == "NULL") {
        header("Location: index.php");
        die;
    }
    if($data == '') {
        header("Location: index.php");
        die;
    }
    //mod stuff
    $tmpModData = json_decode(file_get_contents($filemod), true);
    if(in_array(base64_encode(xorCrypto($xorKey, $author)), $tmpModData["bannedNicknames"])) {
        echo "<!DOCTYPE html><html><head><title>ERROR</title></head><body><fieldset><legend>Banned</legend><p>ERROR: This nickname it's banned, please choose a new one</p><p><a href='index.php'>Go Back</a></p></fieldset></body></html>";
        die;
    }
    if(in_array(base64_encode(xorCrypto($xorKey, $_SERVER["REMOTE_ADDR"])), $tmpModData["bannedIPs"])) {
        echo "<!DOCTYPE html><html><head><title>ERROR</title></head><body><fieldset><legend>Banned</legend><p>ERROR: You're not allowed to send messages, contact the Administrator of this website for more info.</p><p><a href='index.php'>Go Back</a></p></fieldset></body></html>";
        die;
    }
    $messageModel = array(
        "nick" => base64_encode(xorCrypto($xorKey, $author)),
        "ip" => base64_encode(xorCrypto($xorKey, $_SERVER["REMOTE_ADDR"])),
        "message" => base64_encode(xorCrypto($xorKey, $data))
    );
    $data = htmlspecialchars($data); //removing special characters
    basicFileCheck($filedir, $filedb, $filemod, $dataModel, $moderationModel);
    $tmpdata = json_decode(file_get_contents($filedb), true);
    if(sizeof($tmpdata["messages"]) >= $maxMessages && $maxMessages != 0) {
        for($a = 1; $a < sizeof($tmpdata["messages"]); $a++) {
            array_push($dataModel["messages"], $tmpdata["messages"][$a]);
        }
        array_push($dataModel["messages"], $messageModel);
        $fileHandler = fopen($filedb, "w");
        fwrite($fileHandler, json_encode($dataModel));
        fclose($fileHandler);
        header("Location: index.php");
    } else {
        array_push($tmpdata["messages"], $messageModel);
        $fileHandler = fopen($filedb, "w");
        fwrite($fileHandler, json_encode($tmpdata));
        fclose($fileHandler);
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home - Panchat</title>
        <meta http-equiv="refresh" content="<?php if(isset($_COOKIE['autoload5'])) { if($_COOKIE['autoload5'] == 1) { echo $timeoutal5; } if($_COOKIE['autoload5'] == 2) { echo " "; } } else { echo " "; } ?>"/>
    </head>
    <body>
        <form action="index.php" method="POST">
            <fieldset>
                <legend>Chat</legend>
                <!-- CHAT DATA HERE -->
                <?php
                include 'config.inc.php';
                $messageDB = json_decode(file_get_contents($filedb), true);
                if(sizeof($messageDB["messages"]) == 0) {
                    echo "<br>[No messages to show]";
                } else {
                    foreach($messageDB["messages"] as $messages) {
                        $tmpnick = xorCrypto($xorKey, base64_decode($messages["nick"]));
                        $tmpip = xorCrypto($xorKey, base64_decode($messages["ip"]));
                        $tmpmsg = xorCrypto($xorKey, base64_decode($messages["message"]));
                        echo "<br>{$tmpnick}({$tmpip}): {$tmpmsg}";
                    }
                }
                ?>
                <p><b>Nick: </b><input type="text" name="author" value="<?php if(isset($_COOKIE['author'])) { echo $_COOKIE['author'];} else { echo "NULL";} ?>"/></p>
                <p><b>Message: </b><input type="text" name="data" autocomplete="off" value=""/><input type="submit" value="Send"/></p>
                <p><a href="index.php?clear=1">Clear chat</a> | <a href="modAuth.php">Moderation Panel</a> | <a href="settings.php">Settings</a> | <a href="about.html">About</a>
            </fieldset>
        </form>
    </body>
</html>