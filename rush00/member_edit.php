<?php
include('connexion_sql.php');
session_start();
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
else {
  header("Location: 404.php");
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
          <h1 class='indextxt'>Profil: </h1>
          <?php if ($_GET['status'] === 'edit_connexion'): ?>
            <form class="" action="member_edit.php?id=<?= $user[0] ?>&status=edit_connexion" method="post">
              <h3 class='register'>Informations de Connexion</h3>
              <hr class='hrreg2'>
              <input type="text" name="email" placeholder="Adresse email" value="<?= $user[4] ?>" required/>
              <br>
              <input type="password" name="oldpassword" placeholder="Ancien mot de Passe (Min. 6 Caractères)" value="" required/>
              <br>
              <input type="password" name="newpassword" placeholder="Nouveau mot de Passe (Min. 6 Caractères)" value="" required/>
              <br>
              <input type="password" name="passwordverif" placeholder="Mot de Passe (Vérification)" value="" required/>
              <br>
              <input type="submit" name="submit" value="Modifer profil de connexion">
            </form>
          <?php endif; ?>
          <?php if ($_GET['status'] === 'edit_perso'): ?>
            <form class="" action="member_edit.php?id=<?= $user[0] ?>&status=edit_perso" method="post">
              <h3 class='register'>Informations Personnelles</h3>
              <hr class='hrreg2'>
              <h4 class='registersubtitle'>Identité</h4>
              <input type="text" name="firstname" placeholder="Prénom" value="<?= $user[2] ?>" required/>
              <br>
              <input type="text" name="lastname" placeholder="Nom" value="<?= $user[1] ?>" required/>
              <br>
              <br>
              <input type="date" name="birthday" placeholder="Date de Naissance" min="<?php $min = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 100 years")); echo $min;?>" max="<?php
              $max=date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 18 years")); echo $max;?>" value="<?= $user[3] ?>" required/>
              <br>
              <h4 class='registersubtitle'>Contact</h4>
              <input type="text" name="address" placeholder="Adresse" value="<?= $user[6] ?>" required/>
              <br>
              <input type="text" name="city" placeholder="Ville" value="<?= $user[7] ?>" />
              <input type="text" name="postal" placeholder="Code Postal" value="<?= $user[9] ?>" required/>
              <br>
              <input type="text" name="country" placeholder="Pays" value="<?= $user[8] ?>" required/>
              <br>
              <input type="text" name="phone" placeholder="Numéro de Téléphone (Fixe ou Mobile)" value="<?= $user[5] ?>" required/>
              <br>
              <input type="password" name="password" placeholder="Mot de Passe (Min. 6 Caractères)" value="" required/>
              <br>
              <input type="submit" name="submit" value="Modifer le profil">
            </form>
          <?php endif;
          if ($_GET['status'] === 'edit_perso')
          {
            if (isset($_POST['submit']))
            {
              if ($_POST['submit'] === "Modifer le profil" && $_POST['password'] && $_POST['firstname'] && $_POST['lastname'] && $_POST['birthday'] && $_POST['address'] && $_POST['city']
                && $_POST['postal'] && $_POST['country'] && $_POST['phone'] && hash('whirlpool', $_POST['password']) == $user[10])
                {
                  if ($db = connect_db())
                  {
                    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
                    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
                    $birthday = $_POST['birthday'];
                    echo $birthday;
                    $address = mysqli_real_escape_string($db, $_POST['address']);
                    $postal =  $_POST['postal'];
                    $country = mysqli_real_escape_string($db, $_POST['country']);
                    $city = mysqli_real_escape_string($db, $_POST['city']);
                    $phone = $_POST['phone'];
                    $id = $user[0];
                    $q = "UPDATE user SET lastname = '$lastname', firstname = '$firstname', birthday = '$birthday', phone = '$phone', address = '$address', city = '$city', country = '$country', postal = '$postal' WHERE id_user = '$id'";
                    $res = mysqli_query($db, $q);
                    mysqli_free_result($res);
                    mysqli_close($db);
                  }
                  header("Refresh: 0; URL=member.php?id=$user[0]");
                }
              }
            }
          if ($_GET['status'] === 'edit_connexion')
          {
            if (isset($_POST['submit']))
            {
              if ($_POST['submit'] === "Modifer profil de connexion" && $_POST['oldpassword'] && $_POST['newpassword'] && $_POST['passwordverif'])
              {
                if (hash("whirlpool", $_POST['oldpassword']) === $user[10] && $_POST['newpassword'] === $_POST['passwordverif'])
                {
                  if ($db = connect_db())
                  {
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    $pass = hash("whirlpool", $_POST['newpassword']);
                    $q = "UPDATE user SET email = '$email', password = '$pass' WHERE id_user = '$id'";
                    $res = mysqli_query($db, $q);
                    mysqli_free_result($res);
                    mysqli_close($db);
                    header("Refresh: 0; URL=member.php?id=$user[0]");
                  }
                }
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
