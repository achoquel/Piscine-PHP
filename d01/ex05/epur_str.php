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

  function epur($str)
  {
    $tab = ft_split_no_sort($str);
    $ret = implode(" ", $tab);
    return $ret;
  }
  if ($argc > 1)
    print(epur($argv[1])."\n");
?>
