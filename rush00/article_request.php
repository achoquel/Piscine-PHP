<?php
include('connexion_sql.php');
session_start();
if ($db = connect_db())
{
  if ($_POST['submit'] === "Ajouter" && $_POST['name_item'] && $_POST['season'] && $_POST['description'] && $_POST['price'] && $_POST['stock'] && $_POST['type'] && $_POST['link'])
  {
    $name = mysqli_real_escape_string($db, $_POST['name_item']);
    $season = mysqli_real_escape_string($db, $_POST['season']);
    $d = mysqli_real_escape_string($db, $_POST['description']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $price = floatval($price);
    $stock = mysqli_real_escape_string($db,$_POST['stock']);
    $stock = floatval($stock);
    $type = $_POST['type'];
    $link = mysqli_real_escape_string($db, $_POST['link']);
    $q = "INSERT INTO item(link_img, type_id, season, name_item, description, price, stock) VALUES ('$link', '$type', '$season ', '$name', '$d', '$price', '$stock')";
    $res = mysqli_query($db, $q);
    mysqli_free_result($res);
    $q = "SELECT name_type FROM type WHERE id_type = $type";
    $res = mysqli_query($db, $q);
    $type_name = mysqli_fetch_row($res);
    $type_name = $type_name[0];
    mysqli_free_result($res);
    mysqli_close($db);
  }
  header("Refresh: 0; URL=$type_name.php");
}
?>
