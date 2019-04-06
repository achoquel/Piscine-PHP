#!/usr/bin/php
<?php
function is_operator($c, $i)
{
  if ($c[$i] == "+" || $c[$i] == "-" || $c[$i] == "*" || $c[$i] == "/" || $c[$i] == "%")
    return 1;
  return 0;
}

function is_inumeric($str, $i)
{
  if ($str[$i] >= "0" && $str[$i] <= "9")
    return 1;
  return 0;
}

function check_syntax($str)
{
  $len = strlen($str);
  $i = 0;
  // Check for invalid characters
  while ($i < $len)
  {
    if (!is_operator($str, $i) && !is_inumeric($str, $i) && $str[$i] != " ")
      return 1;
    ++$i;
  }
  // Check if what is passed is "nbr operator nbr"
  $i = 0;
  $fn = 0;
  $o = 0;
  $ln = 0;
  while ($i < $len)
  {
    // Check if the first number exists when an operator is met
    if (is_operator($str, $i) && $fn == 0)
      return 1;
    // Check if there's only one operator
    if (is_operator($str, $i) && $o == 1)
      return 1;
    // Check if there is only one number at the left of the operator
    if (is_inumeric($str, $i) && $o == 0 && $fn == 1)
      return 1;
    // Check if there is only one number at the right part of the operator
    if (is_inumeric($str, $i) && $ln == 1)
      return 1;
    // We found the first number
    if (is_inumeric($str, $i) && $o == 0 && ($str[$i + 1] == ' ' || is_operator($str, ($i + 1))))
      $fn = 1;
    // We found the operator
    if (is_operator($str, $i))
      $o = 1;
    // We found the last number
    if (is_inumeric($str, $i) && $o == 1 && ($str[$i + 1] == ' ' || $i + 1 == $len))
      $ln = 1;
    ++$i;
  }
  if ($fn == 0 || $o == 0 || $ln == 0)
    return 1;
  return 0;
}

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

function ft_split_operator($str, $operator)
{
  $tmp = explode($operator, $str);
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

function epur($str)
{
  $tab = ft_split_no_sort($str);
  $ret = implode(" ", $tab);
  return $ret;
}

function get_operator($str)
{
  $i = 0;

  while (!is_operator($str, $i))
    ++$i;
  return $str[$i];
}

function get_numbers($str, $operator)
{
  $str = epur($str);
  $array = ft_split_operator($str, $operator);
  $array[0] = epur($array[0]);
  $array[1] = epur($array[1]);
  return $array;
}

function do_op($str)
{
  $operator = get_operator($str);
  $array = get_numbers($str, $operator);
  if ($operator == "+")
    echo $result = $array[0] + $array[1]."\n";
  else if ($operator == "-")
    echo $result = $array[0] - $array[1]."\n";
  else if ($operator == "*")
    echo $result = $array[0] * $array[1]."\n";
  else if ($operator == "%")
    echo $result = $array[0] % $array[1]."\n";
  else if ($operator == "/")
    echo $result = $array[0] / $array[1]."\n";
}

if ($argc == 2 && !check_syntax($argv[1]))
  do_op($argv[1]);
else
{
  if ($argc != 2)
    echo "Incorrect Parameters\n";
  else if (check_syntax($argv[1]))
    echo "Syntax Error\n";
  }
?>
