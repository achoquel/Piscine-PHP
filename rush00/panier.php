<?php
include('panier_request.php');
if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
}
$items = panier_item();
$price_ttc = 0;
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
        <li><a href="legume.php" class="navtext">Légumes</a></li>
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
          <li style='float:right;'><a href="panier.php" class="active"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
        </ul>
    </div>
    <div class="content">
      <h1 class="indextxt">Récapitulatif du panier: </h1><br>
      <div class="fetl">
      <?php
      if ($_SESSION['panier'] != NULL) {
      foreach ($items as $key => $value)
      {
        foreach ($_SESSION['panier'] as $k => $val) {
        if ($k == $value['id_item']) {
          $price_ttc += ($val * $value['price']) * (1 + 0.2 );
        ?>
        <div class="fruit">
            <img src="<?= $value['link_img']?>" alt="<?= $value['name_item']?>">
            <p><h1 class='indextxt'><?= $value['name_item']?></h1><?= $value['description']?><br>Prix: <?= $value['price']?>€/kg HT<br>Quantité: <?= $val?>kg<br>Prix Total: <?= ($val * $value['price']) * (1 + 0.2 )?>
            € TTC</p>
        </div>
    <?php }
  }
  }
  } ?>
    </div>
    <?php if (!$_SESSION['panier'] == NULL){ ?>
    <div class="pdelete">
      <form action="panier_request.php" method="post">
        <input type="submit" name="submit" value="Vider le panier">
      </form>
    </div>
    <div class="pvalid">
      <form action="panier_request.php" method="post">
        <input type="hidden" name="price_ttc" value="<?=$price_ttc?>">
        <input type="submit" name="submit" value="Valider la commande">
      </form>
    </div>
  <?php } else {?>
    <h1 class="buildtxt"><img src="https://i.imgur.com/ecahXla.png" alt="warning"><br>Votre panier est vide !</h1>
  <?php } ?>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
