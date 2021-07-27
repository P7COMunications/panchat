<?php
/*
 * /=======================================================\
 * | Panchat v2.0.0                                        |
 * | Copyright (c) P7COMunications LLC 2021 - PANCHO7532   |
 * |=======================================================/
 * |-> Purpose: Moderation Control Panel
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
function xorCrypto($key, $data) {
    $result = "";
    for($a = 0, $b = 0; $a < strlen($data); $a++, $b++) {
        if($b >= strlen($key)) { $b = 0; }
        $result .= $data{$a} ^ $key{$b};
    }
    return $result;
}
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
basicFileCheck($filedir, $filedb, $filemod, $dataModel, $moderationModel);
if(isset($_COOKIE['username']) && isset($_COOKIE['passwd'])) {
    $username = htmlspecialchars($_COOKIE['username']);
    $password = htmlspecialchars($_COOKIE['passwd']);
    if(md5(base64_encode(xorCrypto($xorKey, $u1a))) == $username && md5(base64_encode(xorCrypto($xorKey, $u1b))) == $password) {
        echo "<!DOCTYPE html><html><head><title>ModCP - Panchat</title></head><body><fieldset><legend>Welcome, $u1a - <a href='modAuth.php?logout=1'>Logout</a></legend>";
    } else {
        header("Location: error.html");
    }
} else {
    header("Location: error.html");
}
//all authenticated actions for the panel should go after this line
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // it's a POST request
    if(isset($_POST["modAction"]) && isset($_POST["modActionValue"])) {
        if($_POST["modActionValue"] == "") {
            header("Location: modcp.php");
        }
        $tmpModData = json_decode(file_get_contents($filemod), true);
        switch($_POST["modAction"]) {
            case "banNick":
                //action
                $tmpModActionData = base64_encode(xorCrypto($xorKey, htmlspecialchars($_POST["modActionValue"])));
                array_push($tmpModData["bannedNicknames"], $tmpModActionData);
                $fileHandler = fopen($filemod, "w");
                fwrite($fileHandler, json_encode($tmpModData));
                fclose($fileHandler);
                break;
            case "banIP":
                //action
                $tmpModActionData = base64_encode(xorCrypto($xorKey, htmlspecialchars($_POST["modActionValue"])));
                array_push($tmpModData["bannedIPs"], $tmpModActionData);
                $fileHandler = fopen($filemod, "w");
                fwrite($fileHandler, json_encode($tmpModData));
                fclose($fileHandler);
                break;
            case "allowIPC":
                //action
                $tmpModActionData = base64_encode(xorCrypto($xorKey, htmlspecialchars($_POST["modActionValue"])));
                array_push($tmpModData["allowedIPsCLS"], $tmpModActionData);
                $fileHandler = fopen($filemod, "w");
                fwrite($fileHandler, json_encode($tmpModData));
                fclose($fileHandler);
                break;
            default:
                break;
        }
    }
}
if(isset($_GET["removeNick"]) && $_GET["removeNick"] != "") {
    $tmpModData = json_decode(file_get_contents($filemod), true);
    $tmpModData["bannedNicknames"] = array_diff($tmpModData["bannedNicknames"], array($_GET["removeNick"]));
    $fileHandler = fopen($filemod, "w");
    fwrite($fileHandler, json_encode($tmpModData));
    fclose($fileHandler);
}
if(isset($_GET["removeIP"]) && $_GET["removeIP"] != "") {
    $tmpModData = json_decode(file_get_contents($filemod), true);
    $tmpModData["bannedIPs"] = array_diff($tmpModData["bannedIPs"], array($_GET["removeIP"]));
    $fileHandler = fopen($filemod, "w");
    fwrite($fileHandler, json_encode($tmpModData));
    fclose($fileHandler);
}
if(isset($_GET["removeIPc"]) && $_GET["removeIPc"] != "") {
    $tmpModData = json_decode(file_get_contents($filemod), true);
    $tmpModData["allowedIPsCLS"] = array_diff($tmpModData["allowedIPsCLS"], array($_GET["removeIPc"]));
    $fileHandler = fopen($filemod, "w");
    fwrite($fileHandler, json_encode($tmpModData));
    fclose($fileHandler);
}
?>
<form action="modcp.php" method="POST">
    <p>Banned nicknames:</p>
    <ul>
        <?php
        include 'config.inc.php';
        $nickDB = json_decode(file_get_contents($filemod), true);
        if(sizeof($nickDB["bannedNicknames"]) == 0) {
            echo "<li>[No banned nicknames]";
        } else {
            foreach($nickDB["bannedNicknames"] as $nicks) {
                $tmpnick = xorCrypto($xorKey, base64_decode($nicks));
                echo "<li>{$tmpnick} <a href=\"modcp.php?removeNick={$nicks}\">[Remove]</a></li>";
            }
        }
        ?>
    </ul>
    <p>Banned IPs:</p>
    <ul>
        <?php
        include 'config.inc.php';
        $ipDB = json_decode(file_get_contents($filemod), true);
        if(sizeof($ipDB["bannedIPs"]) == 0) {
            echo "<li>[No banned IPs]";
        } else {
            foreach($ipDB["bannedIPs"] as $ips) {
                $tmpip = xorCrypto($xorKey, base64_decode($ips));
                echo "<li>{$tmpip} <a href=\"modcp.php?removeIP={$ips}\">[Remove]</a></li>";
            }
        }
        ?>
    </ul>
    <p>Allowed IPs for clear chat:</p>
    <ul>
        <?php
        include 'config.inc.php';
        $ipcDB = json_decode(file_get_contents($filemod), true);
        if($lockclschat == "disable") {
            echo "[WARNING] 'lockclschat' variable is set to \"disabled\", values in this list will not be used.";
        }
        if(sizeof($ipDB["allowedIPsCLS"]) == 0) {
            echo "<li>[No whitelisted IPs]";
        } else {
            foreach($ipcDB["allowedIPsCLS"] as $ipc) {
                $tmpipc = xorCrypto($xorKey, base64_decode($ipc));
                echo "<li>{$tmpipc} <a href=\"modcp.php?removeIPc={$ipc}\">[Remove]</a></li>";
            }
        }
        ?>
    </ul>
    <p>Add a record:</p>
    Action: <select name="modAction" id="modAction">
        <option value="banNick" selected>Ban Nickname</option>
        <option value="banIP">Ban IP</option>
        <option value="allowIPC">Allow IP (for clear chat)</option>
    </select>
    <br>
    Value: <input type="text" autocomplete="off" name="modActionValue"/>
    <input type="submit" value="Submit"/>
    <br><a href="index.php">Go to the main page</a>
</form>
</fieldset>
</body>
</html>