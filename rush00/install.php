<?php
$db = mysqli_connect('127.0.0.1', 'root', 'maxime');
$cmd = file_get_contents("rush00.sql");
$cmd = explode(";", $cmd);
foreach($cmd as $sql)
{
  mysqli_query($db, $sql);
}
mysqli_close($db);
header("Refresh: 0; URL=index.php");
?>
