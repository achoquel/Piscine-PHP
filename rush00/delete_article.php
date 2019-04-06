<?php
include('connexion_sql.php');
session_start();
if (isset($_GET['id']))
{
  $find = [];
  $id = $_GET['id'];
  if (is_numeric($id))
  {
    if ($db = connect_db())
    {
      $q = "SELECT * FROM item WHERE id_item = $id";
      $res = mysqli_query($db, $q);
      $find = mysqli_fetch_row($res);
      $type = $find[2];
      mysqli_free_result($res);
      $q = "SELECT name_type FROM type WHERE id_type = $type";
      $res = mysqli_query($db, $q);
      $type_name = mysqli_fetch_row($res);
      $type_name = $type_name[0];
      if ($find != NULL)
      {
        $q = "DELETE FROM item WHERE id_item = $id";
        $res = mysqli_query($db, $q);
        mysqli_free_result($res);
      }
      mysqli_close($db);
      header("Location: $type_name.php");
    }
  }
}
?>
