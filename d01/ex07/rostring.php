#!/usr/bin/php
<?php

function ft_split_no_sort($str)
{
  $tmp = explode(" ", $str);
  $tab = array();
  foreach ($tmp as $key)
  {
    if (!empty($key))
    {
      $tab[] = $key;
      ++$tab;
    }
  }
  return $tab;
}

function rostring($str)
{
  $array = ft_split_no_sort($str);
  $size = count($array);
  $i = 1;
  while ($i < $size)
  {
    echo "$array[$i] ";
    ++$i;
  }
  echo "$array[0]\n";
}

if ($argc > 1)
  rostring($argv[1]);
?>
