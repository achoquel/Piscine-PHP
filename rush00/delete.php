<?php
include('connexion_sql.php');
session_start();
if (isset($_GET['id']) && $_SESSION['admin'] == 1)
{
  $find = [];
  $id = $_GET['id'];
  if (is_numeric($id) && $_GET['id'] != 12)
  {
    if ($db = connect_db())
    {
      $q = "SELECT * FROM user WHERE id_user = $id";
      $res = mysqli_query($db, $q);
      $find = mysqli_fetch_row($res);
      mysqli_free_result($res);
      if ($find != NULL)
      {
        $q = "DELETE FROM user WHERE id_user = $id";
        $res = mysqli_query($db, $q);
        mysqli_free_result($res);
      }
      mysqli_close($db);
    header("Refresh: 0; URL=admin.php?action=delete&status=OK");
    }
  }
  else
  {
header("Refresh: 0; URL=admin.php?action=delete&status=KO");  }
}
else
header("Refresh: 0; URL=admin.php?action=delete&status=KO");?>
