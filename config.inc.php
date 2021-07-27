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

// Maximum messages for show in the index
$maxMessages = "10";

// Key used for obfuscate data, be sure to change it on a custom installation
$xorKey = "panchatKey";
?>