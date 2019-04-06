<?php
include('connexion_sql.php');
session_start();
if ($_SESSION['admin'] == 0) {
  header("Refresh: 0; URL=404.php");
}
if (isset($_GET['id']))
{
  if ($db = connect_db())
  {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $id = intval($id);
    if (isset($_SESSION['id']) && $_SESSION['admin'] == 1)
    {
      $q = "SELECT * FROM user WHERE id_user = $id";
      $res = mysqli_query($db, $q);
      $user = mysqli_fetch_row($res);
      mysqli_free_result($res);
      mysqli_close($db);
    }
  }
}
else {
  header("Refresh: 0; URL=404.php");
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
        <div class="edit_profil">
          <h1 class='indextxt'>Profil de l'utilisateur :</h1>
            <form class="" action="edit_profil.php?id=<?= $user[0]?>" method="post">
              <h3 class='register'>Informations de Connexion</h3>
              <hr class='hrreg2'>
              <input type="text" name="email" placeholder="Adresse email" value="<?= $user[4] ?>" required/>
              <br>
              <input type="password" name="newpassword" placeholder="Nouveau mot de Passe (Min. 6 Caractères)" value="" required/>
              <br>
              <input type="password" name="passwordverif" placeholder="Mot de Passe (Vérification)" value="" required/>
              <br>
              Admin <input type="radio" name="admin" value="1" />
              Membre <input type="radio" name="admin" value="0" /><br>
              <input type="submit" name="submit" value="Modifer le profil de l'utilisateur">
            </form>
          <?php
          if (isset($_POST['submit']))
          {
            if ($_POST['submit'] === "Modifer le profil de l'utilisateur" && $_POST['newpassword'] && $_POST['passwordverif'])
            {
              if ($_POST['newpassword'] === $_POST['passwordverif'])
              {
                if ($db = connect_db())
                {
                  $email = mysqli_real_escape_string($db, $_POST['email']);
                  $pass = hash("whirlpool", $_POST['newpassword']);
                  $admin = $_POST['admin'];
                  $admin = intval($admin);
                  $is_user = $_GET['id'];
                  echo "mail : ".$email." ".$admin;
                  $q = "UPDATE user SET email = '$email', password = '$pass', admin = '$admin' WHERE id_user = '$id'";
                  $res = mysqli_query($db, $q);
                  mysqli_free_result($res);
                  mysqli_close($db);
                  header("Refresh: 0; URL=admin.php?action=modify&status=OK");
                }
              }
              else {
                header("Refresh: 0; URL=admin.php?action=modify&status=KO");
              }
            }
          }
          ?>
        </div>
      </div>
    </div>
    <footer class='footer'>
      <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
      <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
    </footer>
  </body>
</html>
