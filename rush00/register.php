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
if ($db = connect_db())
{
  $mail = [];
  $q = 'SELECT email FROM user';
  $res = mysqli_query($db, $q);
  while ($row = mysqli_fetch_array($res))
    $mail[] = $row;
  mysqli_free_result($res);
  mysqli_close($db);
}
?>
<html>
  <head>
    <title>Inscription</title>
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
        <li style='float:right;'><a href='register.php?status=register' class='active'><img src='https://i.imgur.com/BaEl0AW.png' alt='Register'></a></li>
        <li style='float:right;'><a href="panier.php"><img src="https://i.imgur.com/cnbDnfr.png" alt="panier"></a></li>
      </ul>
    </div>
    <?php
    if ($_GET['status'] === 'register' || ($_GET['status'] === 'ko' && $_GET['error']))
    {
     ?>
     <div class="content">
    <h1 class='registertitle'>Inscription</h1>
    <form class="" action="register.php?status=check" method="post">
      <h3 class='register'>Informations de Connexion</h3>
      <hr class='hrreg2'>
      <input type="text" name="email" placeholder="Adresse email" value="" required/><?php
      if ($_GET['status'] === 'ko' && $_GET['error'] === 'eau') {echo "<h6 class='error'> Erreur: Adresse mail déja utilisée !</h6>";} else if ($_GET['status'] === 'ko' && $_GET['error'] === 'ie') {echo "<h6 class='error'> Erreur: Adresse mail invalide !</h6>";}?>
      <br>
      <input type="password" name="password" placeholder="Mot de Passe (Min. 6 Caractères)" value="" required/><?php
      if ($_GET['status'] === 'ko' && $_GET['error'] === 'pwl') {echo "<h6 class='error'> Erreur: Le mot de passe est trop court !</h6>";}?>
      <br>
      <input type="password" name="passwordverif" placeholder="Mot de Passe (Vérification)" value="" required/><?php
      if ($_GET['status'] === 'ko' && $_GET['error'] === 'pwdm') {echo "<h6 class='error'> Erreur: Les mots de passe ne sont pas identiques !</h6>";}?>
      <br>
      <h3 class='register'>Informations Personnelles</h3>
      <hr class='hrreg2'>
      <h4 class='registersubtitle'>Identité</h4>
      <input type="text" name="firstname" placeholder="Prénom" value="" required/>
      <br>
      <input type="text" name="lastname" placeholder="Nom" value="" required/>
      <br>
      <br>
      <input type="date" name="birthday" placeholder="Date de Naissance" min="<?php $min = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 100 years")); echo $min;?>" max="<?php
      $max=date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " - 18 years")); echo $max;?>" value="" required/>
      <br>
      <h4 class='registersubtitle'>Contact</h4>
      <input type="text" name="address" placeholder="Adresse" value="" required/>
      <br>
      <input type="text" name="city" placeholder="Ville" value="" />
      <input type="text" name="postal" placeholder="Code Postal" value="" required/>
      <br>
      <input type="text" name="country" placeholder="Pays" value="" required/>
      <br>
      <input type="text" name="phone" placeholder="Numéro de Téléphone (Fixe ou Mobile)" value="" required/>
      <br>
      <input type="submit" name="submit" value="S'inscrire">
    </form>
<?php
}
else if ($_GET['status'] === 'check')
{
  if ($_POST['submit'] === "S'inscrire" && $_POST['email'] && $_POST['password'] && $_POST['passwordverif'] && $_POST['firstname'] && $_POST['lastname'] && $_POST['birthday'] && $_POST['address'] && $_POST['city']
  && $_POST['postal'] && $_POST['country'] && $_POST['phone'])
  {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
      header("Refresh: 0; URL=register.php?status=ko&error=ie");
    if (strlen($_POST['password']) < 6)
      header("Refresh: 0; URL=register.php?status=ko&error=pwl");
    else if (strcmp($_POST['password'], $_POST['passwordverif']))
      header("Refresh: 0; URL=register.php?status=ko&error=pwdm");
    else
    {
      if ($db = connect_db())
      {
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $same_mail = 0;
        foreach ($mail as $key => $value)
        {
          if($_POST['email'] == $value['email'])
            $same_mail = 1;
        }
        if ($same_mail == 0)
        {
          $pass = hash("whirlpool", mysqli_real_escape_string($db, $_POST['password']));
           $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
           $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
           $birthday = $_POST['birthday'];
           $address = mysqli_real_escape_string($db, $_POST['address']);
           $postal =  mysqli_real_escape_string($db, $_POST['postal']);
           $postal = intval($postal);
           $country = mysqli_real_escape_string($db, $_POST['country']);
           $city = mysqli_real_escape_string($db, $_POST['city']);
           $phone = mysqli_real_escape_string($db, $_POST['phone']);
           $phone = intval($phone);
           $q = "INSERT INTO user(lastname, firstname, birthday, email, phone, address, city, country, postal, password, admin) VALUES ('$lastname', '$firstname', '$birthday', '$email', '$phone', '$address', '$city', '$country', '$postal', '$pass', '0')";
           $res = mysqli_query($db, $q);
           mysqli_free_result($res);
           mysqli_close($db);
           header("Refresh: 0; URL=register.php?status=OK");
        }
        else
          header("Refresh: 0; URL=register.php?status=ko&error=eau");
      }
    }
  }
  else
    header("Refresh: 0; URL=404.php");
  }
else if ($_GET['status'] === 'OK')
{
?>
<h1 class='confirm'>Merci pour votre inscription !<br>Vous allez automatiquement être redirigé vers l'accueil.</h1>
<?php
header('Refresh: 5; URL=index.php');
}
else
  header("Refresh: 0; URL=404.php");
?>
</div>
<footer class='footer'>
  <img src="https://i.imgur.com/yKRm7tc.png" alt="footer_logo" class="footer_name">
  <h1 class='footer_copyright'>© madufour achoquel - 2019</h1>
</footer>
</body>
</html>
