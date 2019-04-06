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
?>
