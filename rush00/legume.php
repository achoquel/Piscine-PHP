<?php
session_start();
include('connexion_sql.php');
if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
}
  if ($db = connect_db())
  {
    $items = [];
    $q = "SELECT id_item, name_item, description, link_img, price, stock FROM item WHERE type_id = 2";
    $res = mysqli_query($db, $q);
    while ($data = mysqli_fetch_array($res))
      $items[] = $data;
    mysqli_free_result($res);
    mysqli_close($db);
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
        <li><a href="legume.php" class="active navtext">Légumes</a></li>
        <li><a href="fruit.php" class="navtext">Fruits</a></li>
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
      <h1 class="indextxt">Catalogue des légumes</h1><br>
      <div class="fetl">
      <?php foreach ($items as $key => $value)
      {?>
        <div class="fruit">
            <img src="<?= $value['link_img']?>" alt="<?= $value['name_item']?>">
            <p><h1 class='indextxt'><?= $value['name_item']?></h1><?= $value['description']?><br>Stock: <?php if(isset($_SESSION['panier'][$value['id_item']])){echo $value['stock'] - $_SESSION['panier'][$value['id_item']];}
            else {echo $value['stock'];} ?> kg<br>Prix: <?= $value['price']?>€/kg</p>
            <form action="panier_request.php?id=<?= $value['id_item']?>" method="post">
              <input type="number" name="quantity" min="0" max="<?php if(isset($_SESSION['panier'][$value['id_item']])){echo $value['stock'] - $_SESSION['panier'][$value['id_item']];}
              else {echo $value['stock'];} ?>" value="" />
              <input type="hidden" name="type" value="2">
              <input type="submit" name="submit" value="+">
            </form>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin']  == 1):?>
              <a href="edit_article.php?id=<?= $value['id_item'] ?>" class="modify">Modifer</a>
              <a href="delete_article.php?id=<?= $value['id_item'] ?>" class="delete">Supprimer</a>
            <?php endif; ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1):?>
        <a href="create_article.php?type=2" class="linkbox">
          <div class="addarticle">
            <h1 class="boxh1">AJOUTER<br>UN<br>PRODUIT</h1>
          </div>
        </a>
    <?php endif; ?>
    </div>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
