#!/usr/bin/php
<?php
function ft_split($str)
{
  $tmp = explode(" ", $str);
  if ($str != NULL)
    sort($tmp);
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
  //We split and sort the array
  $array = ft_split($array_str);
  //We print each word of the array
  foreach ($array as $elem)
      echo "$elem\n";
?>
