#!/usr/bin/php
<?php

function do_op($array)
{
  $array[1] = trim($array[1]);
  $array[2] = trim($array[2]);
  $array[3] = trim($array[3]);
  if ($array[2] == "+")
    echo $result = $array[1] + $array[3]."\n";
  else if ($array[2] == "-")
    echo $result = $array[1] - $array[3]."\n";
  else if ($array[2] == "*")
    echo $result = $array[1] * $array[3]."\n";
  else if ($array[2] == "%")
    echo $result = $array[1] % $array[3]."\n";
  else if ($array[2] == "/")
    echo $result = $array[1] / $array[3]."\n";
}

if ($argc == 4)
  do_op($argv);
else
  echo "Incorrect Parameters\n";
?>
