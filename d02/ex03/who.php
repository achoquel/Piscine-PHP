#!/usr/bin/php
<?php

// Open the file where logs are stored
$fd = fopen('/var/run/utmpx', 'r');

// Create different arrays to store informations
$user = array();
$type = array();
$time = array();
$line = array();
$i = 0;


// Read the binary file 628 chars by 628 chars.
// Because it is binary, we need to use unpack to have it in clear
// unpack first parameter is the structure of what it needs to read
// To know what we need to read, we check the struct of utmpx
// https://github.com/libyal/dtformats/blob/master/documentation/Utmp%20login%20records%20format.asciidoc
// https://docs.oracle.com/cd/E36784_01/html/E36873/utmpx.h-3head.html
// pack(); man to know which letter corresponds to which type
// https://www.php.net/manual/fr/function.pack.php
// a256user : char ut_user[];   -> Size: 256
// a4id     : char ut_id[];     -> Size: 4
// a32line  : char ut_line[];   -> Size: 32
// ipid     : pid_t(int)  ut_pid;            -> Size: 4 (But because it's an int it's 1 so we don't write it)
// itype    : short(same as int) ut_type;    -> Size: 4 (But because it's an int it's 1 so we don't write it)
// I2time   : struct timeval (2 unsigned long)
while ($file = fread($fd, 628))
{
  $file = unpack("a256user/a4id/a32line/ipid/itype/I2time/", $file);
  // We store each value in an array
  $user[$i] = $file[user];
  $user[$i] = trim($user[$i]);
  $type[$i] = $file[type];
  $type[$i] = trim($type[$i]);
  $time[$i] = $file[time1];
  $time[$i] = trim($time[$i]);
  $line[$i] = $file[line];
  $line[$i] = trim($line[$i]);
  ++$i;
}
// The connected users are the one identified by type = 7
$real_user = array_keys($type, '7');
date_default_timezone_set('CET');
foreach ($real_user as $elem)
  echo "$user[$elem] $line[$elem]  ".date('M j H:i', $time[$elem])." \n";
?>
