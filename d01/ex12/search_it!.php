#!/usr/bin/php
<?php

function searchit($argc, $argv)
{
  $key = $argv[1];
  $i = 2;
  while ($i < $argc)
  {
    $array = explode(":", $argv[$i]);
    if ($array[0] == "$key")
      $ret = $array[1];
    ++$i;
  }
  if (isset($ret))
    echo "$ret\n";
  return 0;
}

if ($argc >= 3)
  searchit($argc, $argv);
?>
