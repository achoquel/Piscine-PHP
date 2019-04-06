<?php
include('connexion_sql.php');
session_start();
if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = [];
}
if (isset($_SESSION['id']))
{
  header("Refresh: 0; URL=index.php");
}
if (isset($_GET['status']))
{
  if ($_GET['status'] === 'check')
  {
    if ($db = connect_db())
    {
      $user = [];
      $q = 'SELECT id_user, email, password, admin FROM user';
      $res = mysqli_query($db, $q);
      while ($row = mysqli_fetch_array($res))
        $user[] = $row;
      mysqli_free_result($res);
      $mail = mysqli_real_escape_string($db, $_POST['email']);
      $tmp = hash("whirlpool", mysqli_real_escape_string($db, $_POST['password']));
      $co = 0;
      foreach ($user as $key => $value)
      {
        if($mail === $value['email'])
        {
          if ($value['password'] === $tmp)
          {
            $_SESSION['id'] = $value['id_user'];
            $_SESSION['admin'] = $value['admin'];
            $co = 1;
          }
        }
      }
      mysqli_close($db);
    }
    if ($co == 1)
      header("Refresh: 0; URL=index.php");
    else
      header("Refresh: 0; URL=login.php?status=ko");
  }
}
 ?>
 <html>
   <head>
     <title>Connexion</title>
     <link rel="stylesheet" href="style.css">
   </head>
   <body>
     <?php if (!$_GET || $_GET['status'] === 'ko') {?>
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
           echo "<a href='login.php' class='active'><img src='https://i.imgur.com/L9FrtMx.png' alt='login'></a>";
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
       <h1 class="connect">Connexion</h1>
       <hr class='hrreg2'>
       <form class="login" action="login.php?status=check" method="post">
         <input type="text" name="email" placeholder="Adresse email..." value="" required/>
         <br />
         <input type="password" name="password" placeholder="Mot de passe..." value="" required/>
         <br /><?php
         if (isset($_GET['status']))
         {
           if ($_GET['status'] === 'ko') {echo "<h6 class='error'> Erreur: Les identifiants sont invalides !<br /></h6>";}
         }
         ?>
         <input type="submit" name="submit" value="Se Connecter" />
       </form>
       <h4 class='new'>Nouveau sur le site ? </h4><a href="register.php?status=register" class='create'><h5 class='new'>Créer un compte</h5></a>
     </div>
     <footer class='footer'>
       <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
       <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
     </footer>
     <?php
      } ?>
   </body>
 </html>
