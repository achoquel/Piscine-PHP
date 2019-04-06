<?php
  session_start();
  if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
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
        {?>
          <a href="logout.php?id=<?=$_SESSION['id']?>"><img src='https://i.imgur.com/hOe5XNy.png' alt='logout'></a></li>
          <li style='float:right;'>
          <a href='member.php?id=<?= $_SESSION['id']?>'><img src='https://i.imgur.com/da8BlWN.png' alt='user'></a></li>
        <?php } ?>
          <li style='float:right;'><a href="panier.php"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
        </ul>
    </div>
    <div class="content">
      <img src="https://i.imgur.com/DIFu00b.png" alt="404" class="img404">
      <h1 class="txt404">Oops :(<br>La page que vous demandez n'existes pas !</h1>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
