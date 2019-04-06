<?php

function ft_is_sort($array)
{
  $size = count($array);
  $i = 0;
  while ($i < ($size - 1))
  {
      while ($array[$i] == $array[$i + 1])
        ++$i;
      if ($array[$i] < $array[$i + 1])
      {
          while ($i <= ($size - 1) && $array[$i] < $array[$i + 1])
            ++$i;
          if ($i < ($size - 1))
            return 0;
      }
      else if ($array[$i] > $array[$i + 1])
      {
          while ($i < ($size - 1) && $array[$i] >= $array[$i + 1])
            ++$i;
          if ($i < ($size - 1))
            return 0;
      }
  }
  return 1;
}
?>
