#!/usr/bin/php
<?php

function reg_epur($str)
{
  $str = trim($str);
  $str = preg_replace("/\t/", ' ', $str);
  $str = preg_replace('/\s\s+/', ' ', $str);
  echo $str."\n";
}
if ($argc > 1)
  reg_epur($argv[1]);

?>
