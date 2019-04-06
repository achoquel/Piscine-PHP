<?php
include('connexion_sql.php');
if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
 }
 
function display_order()
{
  $command = [];
  if ($db = connect_db())
  {
    $q = 'SELECT * FROM command';
    $res = mysqli_query($db, $q);
    while ($row = mysqli_fetch_array($res))
    {
      $command[] = $row;
    }
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($command);
}

function displayitem_order()
{
  $item_order = [];
  if ($db = connect_db())
  {
    $q = "SELECT * FROM item_order";
    $res = mysqli_query($db, $q);
    while ($data = mysqli_fetch_array($res))
    {
      $item_order[] = $data;
    }
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($item_order);
}

function find_item($id_item)
{
  if ($db = connect_db())
  {
    $q = "SELECT name_item FROM item WHERE id_item = $id_item";
    $res = mysqli_query($db, $q);
    $find = mysqli_fetch_row($res);
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($find);
}
?>
