#!/usr/bin/php
<?php

function ssap_sort($str1, $str2)
{
  $tmp1 = strtolower($str1);
  $tmp2 = strtolower($str2);
  $order = "abcdefghijklmnopqrstuvwxyz0123456789 !\"\#$%&'()*+,-./:;<=>?@[\\]^_`{|}~";
  $i = 0;
  while ($i < strlen($tmp1) || $i < strlen($tmp2))
  {
    $pos1 = strpos($order, ord($tmp1[$i]));
    $pos2 = strpos($order, ord($tmp2[$i]));
    if ($pos1 < $pos2)
      return -1;
    else if ($pos1 > $pos2)
      return 1;
    else
      ++$i;
  }
  return 0;
}

function ft_split($str)
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
  //We remove the program name from the array
  $removed = array_shift($argv);
  //We implode the array to a string to iterate over every word
  $array_str = implode(" ", $argv);
  //We split the array
  $array = ft_split($array_str);
  //We sort the array by using ssap_sort function
  //Order to be used : https://forum.intra.42.fr/topics/1885/messages?page=1#34247
  usort($array, "ssap_sort");
  //We print the array
  foreach ($array as $elem)
    echo "$elem\n";
?>
