<?php
//**********************************************************//
//***************Panchat Config File***********************//
//********************************************************//
//This configuration file, contains needed parameters for
//the correct functionality of the script.
//If do you config someting wrong, the script, cant work
//fine, please be careful.
//*******************************************************//

//Username of the moderation control panel - Default: admin
$u1a = 'admin';

//Password of the moderation control panel - Default: admin
$u1b = 'admin';

//Enable/disable htmlspecialchars() function (If enabled, embedded html code it will disabled)
$htmspe = 'enable';

//Lock the chat clearing ONLY for allowed ips (if it is enabled, an aditional CPanel will be unlocked for use)
//NOTE: localhost address(::1) always will be allowed to use the delete chat function.
$lockclschat = 'disable';

//Timeout of Auto-Load5 (in secs) - Default: 5
$timeoutal5 = '15';

//File DB for main messages - Default: data.txt
$filedb = 'data.txt';

//File DB for the "Ban Clear chat" function
$filedbcls = 'bancls.txt';

//File DB for the "Ban clear chat" function (list)
$filedbclslist = 'banclslist.txt';

//File DB for banned IPs (message function) - Default: banmsj.txt
$filedbbanmsj = 'banmsj.txt';

//File DB for banned IPs (message function - list) - Default: banmsjlist.txt
$filedbbanmsjlist = 'banmsjlist.txt';

//File DB for banned nicks - Default: banick.txt
$filedbbanick = 'banick.txt';

//File DB for banned nicks (list) - Default: banicklist.txt
$filedbbanicklist = 'banicklist.txt';

//File DB for allowed IPs for clear chat function - Default: allowedipcl.txt
$filedballowedipcl = 'allowedipcl.txt';

//File DB for allowed IPs for clear chat function - Default: allowedipclist.txt
$filedballowedipclist = 'allowedipclist.txt';
?>