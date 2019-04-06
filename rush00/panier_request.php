<?php
date_default_timezone_set('UTC');
session_start();
include('connexion_sql.php');
if (isset($_POST['submit']) && $_POST['submit'] === "+" && isset($_GET['id']))
{
  if ($db = connect_db()) {
    $id_item = mysqli_real_escape_string($db, $_GET['id']);
    $id_item = intval($id_item);
    mysqli_close($db);
  }
  if ($_POST['quantity'])
  {
    $qua = $_POST['quantity'];
    if ($_SESSION['panier'] == NULL)
    {
      echo "empty : \n";
      $_SESSION['panier'] = array($id_item => $qua);
    }
    else
    {
      print_r($_SESSION['panier']);
      echo "deja plein \n";
      foreach ($_SESSION['panier'] as $key => $value)
      {
        if ($key == $id_item)
        {
          $_SESSION['panier'][$key] += $qua;
        }
      }
      if ($_SESSION['panier']['id_item'] == NULL)
      {
        echo "empty : \n";
        $_SESSION['panier'] += array($id_item => $qua);
      }
    }
  }
  if ($_POST['type'] == 2) {
    header("REFRESH: 0; URL=legume.php?status=ok");
  }
  else {
    header("REFRESH: 0; URL=fruit.php?status=ok");
  }
}

function panier_item()
{
  if ($db = connect_db())
  {
    $items = [];
    $q = "SELECT id_item, name_item, type_id, description, link_img, price, stock FROM item";
    $res = mysqli_query($db, $q);
    while ($data = mysqli_fetch_array($res))
      $items[] = $data;
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($items);
}

if (isset($_POST['submit']) && $_POST['submit'] === "Valider la commande") {
  if(isset($_SESSION['id']))
  {
    if ($db = connect_db())
    {
      $id_user = $_SESSION['id'];
      $date_command = date('Y-m-d H:i:s');
      print($date_command);
      $price_command = $_POST['price_ttc'];
      $status = "validée";
      $q = "INSERT INTO command(id_user, date_command, price_command, status ) VALUES ('$id_user', '$date_command', '$price_command', '$status')";
      $res = mysqli_query($db, $q);
      $q = "SELECT id_command FROM command WHERE date_command = '$date_command' AND id_user = $id_user";
      $res = mysqli_query($db, $q);
      $row = mysqli_fetch_row($res);
      $id_command = $row[0];
      foreach ($_SESSION['panier'] as $key => $value)
      {
        $quantity = $value;
        $id_item = $key;
        $q = "INSERT INTO item_order(id_item, id_order, quantity) VALUES ('$id_item', '$id_command', '$quantity')";
        $res = mysqli_query($db, $q);
        $quest = "SELECT stock FROM item WHERE id_item = $id_item";
        $res = mysqli_query($db, $quest);
        $row2 = mysqli_fetch_row($res);
        $row2 = $row2[0];
        $newstock = $row2 - $quantity;
        echo $newstock;
        $qst = "UPDATE item SET stock = '$newstock' WHERE id_item = '$id_item'";
        $result = mysqli_query($db, $qst);
      }
      $_SESSION['panier'] = [];
      mysqli_close($db);
      header("REFRESH: 0; URL=index.php?status=cvalid");
    }
  }
  else
    header("REFRESH: 0; URL=login.php");
}

if (isset($_POST['submit']) && $_POST['submit'] === "Vider le panier")
{
  $_SESSION['panier'] = [];
  header("REFRESH: 0; URL=panier.php");
}
?>
