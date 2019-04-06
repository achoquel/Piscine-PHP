#!/usr/bin/php
<?php

function check_time_format($time)
{
  //Check if format is good
  if (preg_match('/^[a-zA-Z]+ [0-9]{1,2} [a-zA-Z]+ [0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/', $time) != 1)
    return 1;
  //Split the time to analyze each word
  $array = explode(' ', $time);
  //Check if day is good
  if (preg_match('/^[Ll]undi$|^[Mm]ardi$|^[Mm]ercredi$|^[Jj]eudi$|^[Vv]endredi$|^[Ss]amedi$|^[Dd]imanche$/', $array[0]) != 1)
    return 1;
  //Check if month is good
  if (preg_match('/^[Jj]anvier$|^[Ff]evrier$|^[Mm]ars$|^[Aa]vril$|^[Mm]ai$|^[Jj]uin$|^[Jj]uillet$|^[Aa]out$|^[Ss]eptembre$|^[Oo]ctobre$|^[Nn]ovembre$|^[Dd]ecembre$/', $array[2]) != 1)
    return 1;
}

function month_converter($month)
{
  if (preg_match('/^[Jj]anvier$/', $month))
    return 1;
  if (preg_match('/^[Ff]evrier$/', $month))
    return 2;
  if (preg_match('/^[Mm]ars$/', $month))
    return 3;
  if (preg_match('/^[Aa]vril$/', $month))
    return 4;
  if (preg_match('/^[Mm]ai$/', $month))
    return 5;
  if (preg_match('/^[Jj]uin$/', $month))
    return 6;
  if (preg_match('/^[Jj]uillet$/', $month))
    return 7;
  if (preg_match('/^[Aa]out$/', $month))
    return 8;
  if (preg_match('/^[Ss]eptembre$/', $month))
    return 9;
  if (preg_match('/^[Oo]ctobre$/', $month))
    return 10;
  if (preg_match('/^[Nn]ovembre$/', $month))
    return 11;
  if (preg_match('/^[Dd]ecembre$/', $month))
    return 12;
}

function calc_time($time)
{
  $date = explode(' ', $time);
  $date[2] = month_converter($date[2]);
  $time = explode(':', $date[4]);
  date_default_timezone_set('CET');
  return mktime($time[0], $time[1], $time[2], $date[2], $date[1], $date[3]);
}

function one_more_time($time)
{
  if (check_time_format($time))
  {
    echo "Wrong Format\n";
    return 0;
  }
  echo $sec = calc_time($time)."\n";
}

if ($argc > 1)
  one_more_time($argv[1]);

?>
