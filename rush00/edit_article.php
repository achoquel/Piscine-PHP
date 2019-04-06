<?php
include('connexion_sql.php');
session_start();
if (!(isset($_SESSION)) || $_SESSION['admin'] == 0)
{
  header("Refresh: 0; URL=index.php");
}
$item = [];
if (isset($_GET['id']))
{
  if ($db = connect_db())
  {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $id = intval($id);
    $q = "SELECT name_item, type_id, season, description, link_img, price, stock FROM item WHERE id_item = $id";
    $res = mysqli_query($db, $q);
    $item = mysqli_fetch_row($res);
    mysqli_free_result($res);
    mysqli_close($db);
  }
}
?>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="header">
      <a href="index.php"><img src="https://i.imgur.com/OC0NJKA.png" alt="logo"></a>
    </div>
    <div class='navbar'>
      <ul>
        <li><a href="index.php"><img src="https://i.imgur.com/S4U8eLw.png" alt="home"></a></li>
        <?php if ($item[1] == 1) {?>
          <li><a href="legume.php" class="navtext">Légumes</a></li>
          <li><a href="fruit.php" class="active navtext">Fruits</a></li>
        <?php }
        else {?>
          <li><a href="legume.php" class="active navtext">Légumes</a></li>
          <li><a href="fruit.php" class="navtext">Fruits</a></li>
        <?php } ?>
        <li><a href="about.php" class="navtext">À Propos</a></li>
        <li style='float:right;'><?php
        if (!isset($_SESSION['id']))
          echo "<a href='login.php'><img src='https://i.imgur.com/L9FrtMx.png' alt='login'></a>";
        else
        {?>
          <a href="logout.php?id=<?=$_SESSION['id']?>"><img src='https://i.imgur.com/hOe5XNy.png' alt='logout'></a></li>
          <li style='float:right;'>
          <a href='member.php?id=<?= $_SESSION['id']?>'><img src='https://i.imgur.com/da8BlWN.png' alt='user'></a></li>
        <?php } ?>
          <li style='float:right;'><a href="panier.php"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
      </ul>
    </div>
    <div class="content">
      <form action="edit_article.php?id=<?= $_GET['id'] ?>" method="post">
        <input type="text" name="name_item" placeholder="Nom du Produit..." value="<?= $item[0]?>" required> <br>
        <input type="radio" name="season" value="hiver" required> Hiver
        <input type="radio" name="season" value="printemps" required> Printemps
        <input type="radio" name="season" value="ete" required> Été
        <input type="radio" name="season" value="automne" required> Automne<br>
        <input type="text" name="description" placeholder="Description..." maxlength="256" cols="800" rows="10" value="<?= $item[3]?>" required> <br>
        <input type="text" name="price" placeholder="Prix au kilo..." value="<?= $item[5]?>" required> <br>
        <input type="text" name="stock" placeholder="Stock..." value="<?= $item[7]?>" required> <br>
        <input type="text" name="link" placeholder="Lien image..." value="<?= $item[4]?>"><br>
        <input type="submit" name="submit" value="Modifier article">
      </form>
      <?php
      if (isset($_POST['submit']))
      {
        if ($_POST['submit'] === "Modifier article" && $_POST['name_item'] && $_POST['season'] && $_POST['description'] && $_POST['price'] && $_POST['stock'] && $_POST['link'])
        {
          if ($db = connect_db())
          {
            $id_item = mysqli_real_escape_string($db, $_GET['id']);
            $id_item = intval($id);
            $name = mysqli_real_escape_string($db, $_POST['name_item']);
            $season = mysqli_real_escape_string($db, $_POST['season']);
            $d = mysqli_real_escape_string($db, $_POST['description']);
            $price = mysqli_real_escape_string($db, $_POST['price']);
            $price = floatval($price);
            $stock = mysqli_real_escape_string($db,$_POST['stock']);
            $stock = floatval($stock);
            $link = mysqli_real_escape_string($db, $_POST['link']);
            $q = "UPDATE item SET name_item = '$name', season = '$season' , description = '$d', link_img = '$link', price = '$price', stock = '$stock' WHERE id_item = '$id_item'";
            $res = mysqli_query($db, $q);
            mysqli_free_result($res);
            $q = "SELECT type_id FROM item WHERE id_item = $id_item";
            $res = mysqli_query($db, $q);
            $type_id = mysqli_fetch_row($res);
            mysqli_free_result($res);
            $type_id = $type_id[0];
            $q = "SELECT name_type FROM type WHERE id_type = $type_id";
            $res = mysqli_query($db, $q);
            $type_name = mysqli_fetch_row($res);
            $type_name = $type_name[0];
            mysqli_free_result($res);
            print_r($type_name);
            mysqli_close($db);
            header("Refresh: 0; URL=$type_name.php");
          }
        }
      }
      ?>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
