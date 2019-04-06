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
        <li><a href="index.php" class="active"><img src="https://i.imgur.com/S4U8eLw.png" alt="home"></a></li>
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
      <div class="index">
        <div class="news">
          <?php if (isset($_GET['status']) && $_GET['status'] == 'cvalid')
          echo "<h1 class='confirm'><img src='https://i.imgur.com/p5ufTFo.png' alt='OK'><br>Merci pour votre commande !<br>Vous pouvez la consulter dans votre espace membre !</h1>";
          ?>
          <h1 class='indextxt'>Nouveautés</h1>
          <p class='indexdesc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non neque justo. Cras ut nunc quis arcu viverra maximus a id elit. Pellentesque felis nisi, tempus ut porttitor sit amet, ornare quis dui. Phasellus pretium gravida finibus. Vivamus laoreet purus quis nisl luctus scelerisque. Quisque vel arcu eget odio pretium laoreet. Fusce vel interdum enim, bibendum ornare orci. Fusce lacinia, felis eget pellentesque porttitor, turpis ligula bibendum augue, et rutrum sapien turpis sit amet leo. Fusce eget elementum lacus. Suspendisse posuere, nibh sit amet consectetur hendrerit, tortor odio scelerisque nisl, a consequat est mi ultricies enim. Aenean ac volutpat ex. Maecenas orci odio, lacinia a egestas vel, congue in augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut dui justo, rutrum sit amet ligula consectetur, tempor tempus massa.<br><br><br>In dignissim mauris in sapien facilisis aliquam. Suspendisse et ligula ullamcorper, finibus quam at, sodales massa. Cras porta imperdiet malesuada. Nulla dictum nisi vitae leo bibendum gravida. Sed luctus aliquam ante eu ullamcorper. Sed imperdiet elementum nibh, ac pulvinar enim tempor nec. Nam aliquet semper ligula, eget maximus metus dignissim ut. Proin eget massa tristique, ultricies nisi a, ornare neque. Aenean elementum mattis diam, et pharetra arcu tincidunt tincidunt. Quisque convallis erat ac tortor hendrerit, eget vehicula justo pharetra. Nam non pharetra mi. Donec eget aliquet dui, et varius sem. Nulla facilisi.</p>
        </div>
        <h1 class="indextxt">Découvrez nos fruits & légumes stars de la saison</h1><br>
        <div class="fetl">
          <div class="fruit">
              <img src="https://i.imgur.com/RoAE6bX.jpg" alt="cerises">
              <p><h1 class='indextxt'>Cerises</h1>Petite description(idée recette etc)</p>
          </div>
          <div class="fruit">
              <img src="https://i.imgur.com/JiUpu0D.jpg" alt="avocats">
              <p><h1 class='indextxt'>Avocats</h1>Petite description(idée recette etc)</p>
          </div>
          <div class="fruit">
              <img src="https://i.imgur.com/tbwLMzS.jpg" alt="mangue">
              <p><h1 class='indextxt'>Mangues</h1>Petite description(idée recette etc)</p>
          </div>
          <br>
          <div class="fruit">
              <img src="https://i.imgur.com/A1Qkxvs.jpg" alt="carottes">
              <p><h1 class='indextxt'>Carottes</h1>Petite description(idée recette etc)</p>
          </div>
          <div class="fruit">
              <img src="https://i.imgur.com/8hZBp59.jpg" alt="poireaux">
              <p><h1 class='indextxt'>Poireaux</h1>Petite description(idée recette etc)</p>
          </div>
          <div class="fruit">
              <img src="https://i.imgur.com/W5D6XqX.jpg" alt="choux blanc">
              <p><h1 class='indextxt'>Choux Blanc</h1>Petite description(idée recette etc)</p>
          </div>
        </div>
      </div>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
