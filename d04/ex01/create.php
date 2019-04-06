<?php

function init_passwd()
{
  $array = array();
  $serialized = serialize($array);
  file_put_contents("../private/passwd", $serialized);
}

function check()
{
  if (!($_POST['login']) || !($_POST['passwd']) || $_POST['submit'] !== "OK")
    return 1;
  $array = unserialize(file_get_contents("../private/passwd"));
  foreach ($array as $line)
  {
    foreach ($line as $key => $value)
    {
      if ($value === $_POST['login'])
        return 1;
    }
  }
  return 0;
}
function add_user()
{
  $array = unserialize(file_get_contents("../private/passwd"));
  $passwd = hash('whirlpool', $_POST['passwd']);
  $new_user = array("login" => $_POST['login'], 'passwd' => $passwd);
  $array[] = array("login" => $_POST['login'], 'passwd' => $passwd);
  $serialized = serialize($array);
  file_put_contents("../private/passwd", $serialized);
}
if (!is_dir('../private'))
  mkdir ('../private');
if (!file_exists("../private/passwd"))
  init_passwd();
if ($_POST['submit'] === "OK" && !check())
{
  add_user();
  echo "OK\n";
}
else
  echo "ERROR\n";
?>
