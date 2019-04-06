<?php
session_start();
if ($_SESSION['admin'] == 0) {
  header("Refresh: 0; URL=index.php");
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
        <li><a href="legume.php" class="navtext">Légumes</a></li>
        <li><a href="fruit.php" class="navtext">Fruits</a></li>
        <li><a href="about.php" class="navtext">À Propos</a></li>
        <li style='float:right;'><?php
        if (!isset($_SESSION['id']))
          echo "<a href='login.php'><img src='https://i.imgur.com/L9FrtMx.png' alt='login'></a>";
        else
        {
          echo "<a href='logout.php'><img src='https://i.imgur.com/hOe5XNy.png' alt='logout'></a>";?></li>
          <li style='float:right;'><?php
          echo "<a href='member.php'><img src='https://i.imgur.com/da8BlWN.png' alt='user'></a>";?></li>
        <?php } ?>
          <li style='float:right;'><a href="panier.php"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
      </ul>
    </div>
    <div class="content">
      <form action="article_request.php" method="post">
        <input type="text" name="name_item" placeholder="Nom du Produit..." value="" required> <br>
        <input type="radio" name="season" value="hiver" required> Hiver
        <input type="radio" name="season" value="printemps" required> Printemps
        <input type="radio" name="season" value="ete" required> Été
        <input type="radio" name="season" value="automne" required> Automne<br>
        <input type="text" name="description" placeholder="Description..." maxlength="256" cols="800" rows="10" value="" required> <br>
        <input type="text" name="price" value="" placeholder="Prix au kilo..." required> <br>
        <input type="text" name="stock" value="" placeholder="Stock..." required> <br>
        <input type="text" name="link" placeholder="Lien image..." value=""> <br>
        <input type="hidden" name="type" value="<?= $_GET['type'] ?>">
        <input type="submit" name="submit" value="Ajouter">
      </form>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
