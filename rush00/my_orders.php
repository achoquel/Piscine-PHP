<?php
session_start();
if (!isset($_SESSION['panier'])) {
   $_SESSION['panier'] = [];
 }
 include('my_order_request.php');
 if (!isset($_SESSION['id']))
 {
   header("Refresh: 0; URL=index.php");
 }
 $orders = display_order();
 $item_order = displayitem_order();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Mes Commandes</title>
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
          <a href='member.php?id=<?= $_SESSION['id']?>' class='active'><img src='https://i.imgur.com/da8BlWN.png' alt='user'></a></li>
        <?php } ?>
          <li style='float:right;'><a href="panier.php"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
      </ul>
    </div>
    <div class="content">
      <div class="commandlist" style="overflow-x:auto;">
        <h1 class='indextxt'>Liste des Commandes</h1>
        <table>
          <tr>
            <th>Numero de Commande</th>
            <th>Date</th>
            <th>Produits</th>
            <th>Status</th>
            <th>Montant</th>
          </tr>
          <?php foreach ($orders as $key => $value): ?>
            <tr>
              <td><?= $value['id_command']?></td>
              <td><?= $value['date_command']?></td>
              <td>
              <?php foreach ($item_order as $k => $val) {
                if ($val['id_order'] == $value['id_command']) {
                  $item = find_item($val['id_item']);
                  echo $item[0]."[".$val['quantity']."] ";
                }
              } ?></td>

              <td><?= $value['status']?></td>
              <td><?= $value['price_command']?>€</td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
