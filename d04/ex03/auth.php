<?php

function auth($login, $passwd)
{
  if ($login && $passwd)
  {
    $array = unserialize(file_get_contents("../private/passwd"));
    foreach ($array as $key => $val)
    {
      if ($val['login'] == $login)
      {
        $hpw = hash('whirlpool', $passwd);
        if ($hpw == $val['passwd'])
          return TRUE;
        else
          return FALSE;
      }
    }
  }
  return FALSE;
}

?>
