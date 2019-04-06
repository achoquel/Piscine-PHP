<?php
function connect_db()
{
  if ($db = mysqli_connect('localhost', 'root', 'maxime', 'rush00'))
  {
    return ($db);
  }
  else {
    header("Refresh: 0; URL=404.php");
    die();
  }
}
?>
