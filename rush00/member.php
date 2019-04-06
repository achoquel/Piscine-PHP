<?php
include('connexion_sql.php');
session_start();
if (!isset($_SESSION['panier'])) {
   $_SESSION['panier'] = [];
 }
if (isset($_GET['id']))
{
  if ($db = connect_db())
  {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $id = intval($id);
    if (isset($_SESSION['id']) && $_SESSION['id'] == $id)
    {
      $q = "SELECT * FROM user WHERE id_user = $id";
      $res = mysqli_query($db, $q);
      $user = mysqli_fetch_row($res);
      mysqli_free_result($res);
      mysqli_close($db);
    }
  }
}
?>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
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
          echo "<a href='logout.php?id=$id'><img src='https://i.imgur.com/hOe5XNy.png' alt='logout'></a>";?></li>
          <li style='float:right;'><?php
          echo "<a href='member.php' class='active'><img src='https://i.imgur.com/da8BlWN.png' alt='user'></a>";?></li>
        <?php } ?>
          <li style='float:right;'><a href="panier.php"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
      </ul>
    </div>
    <div class="content">
      <div class="news">
        <h1 class='indextxt'>Nouveautés</h1>
        <p class='indexdesc'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non neque justo. Cras ut nunc quis arcu viverra maximus a id elit. Pellentesque felis nisi, tempus ut porttitor sit amet, ornare quis dui. Phasellus pretium gravida finibus. Vivamus laoreet purus quis nisl luctus scelerisque. Quisque vel arcu eget odio pretium laoreet. Fusce vel interdum enim, bibendum ornare orci. Fusce lacinia, felis eget pellentesque porttitor, turpis ligula bibendum augue, et rutrum sapien turpis sit amet leo. Fusce eget elementum lacus. Suspendisse posuere, nibh sit amet consectetur hendrerit, tortor odio scelerisque nisl, a consequat est mi ultricies enim. Aenean ac volutpat ex. Maecenas orci odio, lacinia a egestas vel, congue in augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut dui justo, rutrum sit amet ligula consectetur, tempor tempus massa.<br><br><br>In dignissim mauris in sapien facilisis aliquam. Suspendisse et ligula ullamcorper, finibus quam at, sodales massa. Cras porta imperdiet malesuada. Nulla dictum nisi vitae leo bibendum gravida. Sed luctus aliquam ante eu ullamcorper. Sed imperdiet elementum nibh, ac pulvinar enim tempor nec. Nam aliquet semper ligula, eget maximus metus dignissim ut. Proin eget massa tristique, ultricies nisi a, ornare neque. Aenean elementum mattis diam, et pharetra arcu tincidunt tincidunt. Quisque convallis erat ac tortor hendrerit, eget vehicula justo pharetra. Nam non pharetra mi. Donec eget aliquet dui, et varius sem. Nulla facilisi.</p>
      </div>
      <h1 class="indextxt">Gestion Utilisateur</h1><br>
      <div class="fetl">
        <a href="member_edit.php?id=<?= $id ?>&status=edit_perso" class="linkbox">
        <div class="personalbox">
          <h1 class="boxh1">Informations Personnelles</h1>
        </div>
        </a>
        <a href="member_edit.php?id=<?= $id ?>&status=edit_connexion" class="linkbox">
        <div class="connexionbox">
          <h1 class="boxh1">Mes Identifiants</h1>
        </div>
        </a>
          <?php
          if ($_SESSION['admin'] == 0)
          {
            ?>
            <a href="my_orders.php" class="linkbox">
            <div class="orderbox">
              <h1 class="boxh1">Mes Commandes</h1>
            </div>
            </a>
            <?php
          }
           ?>
           <?php
           if ($_SESSION['admin'] == 1)
           {
             ?>
             <a href="admin.php" class="linkbox">
             <div class="orderbox">
               <h1 class="boxh1">Page <br>Admin</h1>
             </div>
             </a>
             <?php
           }
            ?>
      </div>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
