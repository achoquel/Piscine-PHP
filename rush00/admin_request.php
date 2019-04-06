<?php
include('connexion_sql.php');
if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
  header("Refresh: 0; URL=404.php");
}
if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
 }
function ft_users()
{
  $users = [];
  if ($db = connect_db())
  {
    $q = 'SELECT id_user, lastname, firstname, email, phone, city, birthday FROM user';
    $res = mysqli_query($db, $q);
    while ($row = mysqli_fetch_array($res))
    {
      $users[] = $row;
    }
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($users);
}

function ft_finduser($id_user)
{
  if ($db = connect_db())
  {
    $q = "SELECT lastname, firstname FROM user WHERE id_user = $id_user";
    $res = mysqli_query($db, $q);
    $find = mysqli_fetch_row($res);
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($find);
}

function items()
{
  $items = [];
  if ($db = connect_db())
  {
    $q = 'SELECT name_item, description FROM item';
    $res = mysqli_query($db, $q);
    while ($data = mysqli_fetch_array($res))
      $items[] = $data;
    mysqli_free_result($res);
    mysqli_close($db);
  }
  return ($items);
}

if (isset($_POST['submit']) && $_POST['submit'] === "Créer l'utilisateur")
{
  if (strlen($_POST['password']) < 6)
    header("Refresh: 0; URL=admin.php?action=adduser&status=KO");
  else if (strcmp($_POST['password'], $_POST['passwordverif']))
    header("Refresh: 0; URL=admin.php?action=adduser&status=KO");
  else
  {
    if ($db = connect_db())
    {
      $mail = [];
      $q = 'SELECT email FROM user';
      $res = mysqli_query($db, $q);
      while ($row = mysqli_fetch_array($res))
        $mail[] = $row;
      mysqli_free_result($res);
      $same_mail = 0;
      foreach ($mail as $key => $value)
      {
        if($_POST['email'] == $value['email'])
          $same_mail = 1;
      }
      if ($same_mail == 0)
      {
         $pass = hash("whirlpool", mysqli_real_escape_string($db, $_POST['password']));
         $admin = $_POST['admin'];
         $admin = intval($admin);
         $email = mysqli_real_escape_string($db, $_POST['email']);
         $q = "INSERT INTO user(email, password, admin) VALUES ('$email', '$pass', '$admin')";
         $res = mysqli_query($db, $q);
         mysqli_free_result($res);
         mysqli_close($db);
         header("Refresh: 0; URL=admin.php?action=adduser&status=OK");
      }
      else
      header("Refresh: 0; URL=admin.php?action=adduser&status=KO");
    }
  }
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
