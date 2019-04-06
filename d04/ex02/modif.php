<?php
function check()
{
  if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] === 'OK')
  {
    $array = unserialize(file_get_contents("../private/passwd"));
    foreach ($array as $key => $val)
    {
      if ($val['login'] == $_POST['login'])
      {
        $hpw = hash('whirlpool', $_POST['oldpw']);
        if ($hpw == $val['passwd'])
          return 0;
        else
          return 1;
      }
    }
  }
  return 1;
}

function change_pw()
{
  $array = unserialize(file_get_contents("../private/passwd"));
  $i = 0;
  foreach ($array as $key => $value)
  {
    if ($value['login'] === $_POST['login'])
    {
      $array[$i]['passwd'] = hash('whirlpool', $_POST['newpw']);
      $serialized = serialize($array);
      file_put_contents("../private/passwd", $serialized);
      echo "OK\n";
      return 0;
    }
    ++$i;
  }
}

if (check())
  echo "ERROR\n";
else
  change_pw();
?>
