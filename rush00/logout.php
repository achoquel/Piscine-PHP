<?php
session_start();
if (isset($_GET['id']))
{
  if (isset($_SESSION['id']) && $_SESSION['id'] === $_GET['id'])
  {
    $_SESSION['id']= "";
    $_SESSION['admin'] = "";
    $_SESSION['panier'] = [];
    session_destroy();
  }
}
header("Location: index.php");
?>
