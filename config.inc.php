<?php
/*
 * /=======================================================\
 * | Panchat v2.0.0                                        |
 * | Copyright (c) P7COMunications LLC 2021 - PANCHO7532   |
 * |=======================================================/
 * |-> Purpose: Configuration Parameters
 * ---------------------------------------------------------
 * This configuration file, contains needed parameters for the correct functionality of the script.
 * If you config someting wrong, Panchat will not work as intended, please be careful.
 */
// Username for the moderation control panel - Default: admin
$u1a = "admin";

// Password for the moderation control panel - Default: admin
$u1b = "admin";

// Enable chat cleanup only for allowed IPs (if it's enabled, an aditional CPanel will be unlocked for use)
// NOTE: localhost (::1) will always be allowed to use this function.
$lockclschat = "disable";

// Timeout of Auto-Load5 (in secs) - Default: 5
$timeoutal5 = "15"; //uhh deprecated? I don't think i'm ready for use javascript at browser levels for this time.

// Directory for dynamic files (moderation data, saved messages)
// Be sure to keep "./" as indicates the same directory than this file, unless you need an specific path.
$filedir = "./data/";

// File DB for main messages - Default: data.json
$filedb = "{$filedir}data.json";

// File DB for moderation data (banned IPs, Nicks, whitelists, etc)
$filemod = "{$filedir}modData.json";

$maxMessages = "10";

$xorKey = "panchatKey";
/*
// This is unnecesary as fuck, why i did this lmao
// I can't blame, i was a newbie in those years
// NOTE FOR LATER, remove these when i finish the project
// File DB for the "Ban Clear chat" function
$filedbcls = 'bancls.txt';

// File DB for the "Ban clear chat" function (list)
$filedbclslist = 'banclslist.txt';

// File DB for banned IPs (message function) - Default: banmsj.txt
$filedbbanmsj = 'banmsj.txt';

// File DB for banned IPs (message function - list) - Default: banmsjlist.txt
$filedbbanmsjlist = 'banmsjlist.txt';

// File DB for banned nicks - Default: banick.txt
$filedbbanick = 'banick.txt';

// File DB for banned nicks (list) - Default: banicklist.txt
$filedbbanicklist = 'banicklist.txt';

// File DB for allowed IPs for clear chat function - Default: allowedipcl.txt
$filedballowedipcl = 'allowedipcl.txt';

// File DB for allowed IPs for clear chat function - Default: allowedipclist.txt
$filedballowedipclist = 'allowedipclist.txt';
*/
?>