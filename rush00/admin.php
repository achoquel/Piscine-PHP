<?php
session_start();
if (!isset($_SESSION['panier'])) {
   $_SESSION['panier'] = [];
 }
include('admin_request.php');
if (!(isset($_SESSION)) || $_SESSION['admin'] == 0)
{
  header("Location: 404.php");
}
$orders = display_order();
$item_order = displayitem_order();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Administrateur</title>
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
            <th>Client</th>
            <th>Produits</th>
            <th>Prix TTC</th>
            <th>Status</th>
          </tr>
          <?php foreach ($orders as $key => $value): ?>
            <tr>
              <?php $user = ft_finduser($value['id_user']);?>
              <td><?= $value['id_command']?></td>
              <td><?= $value['date_command']?></td>
              <td><?= $user[0]." ".$user[1]?></td>
              <td>
              <?php foreach ($item_order as $k => $val) {
                if ($val['id_order'] == $value['id_command']) {
                  $item = find_item($val['id_item']);
                  echo $item[0]."[".$val['quantity']."] ";
                }
              } ?></td>
              <td><?= $value['price_command']?>€</td>
              <td><?= $value['status']?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <div class="userlist" style="overflow-x:auto;">
        <h1 class='indextxt'>Liste des Utilisateurs</h1>
        <table>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Ville</th>
            <th>Date de naissance</th>
            <th>Action</th>
          </tr>
          <?php
          foreach (ft_users() as $key => $value)
          {
            ?>
            <tr>
              <?php
              echo "<td>".$value['lastname']."</td>
              <td>".$value['firstname']."</td>
              <td>".$value['email']."</td>
              <td>".$value['phone']."</td>
              <td>".$value['city']."</td>
              <td>".$value['birthday']."</td><td>"
              ?>
              <a href="edit_profil.php?id=<?= $value['id_user']?>" class="modify">Modifier</a> <a href="delete.php?id=<?= $value['id_user']?>" class="delete">Supprimer</a></td>
            </tr>
            <?php
          }
           ?>
        </table><?php
        if (isset($_GET['action']) && isset($_GET['status'])) {
          if ($_GET['action'] == "modify" && $_GET['status'] == "OK")
            echo "<h5 class='error' style='color:green'>L'utilisateur a bien été modifié !";
          else if ($_GET['action'] == "modify" && $_GET['status'] == "KO")
              echo "<h5 class='error'>Une erreur est survenue durant la modification !";
          if ($_GET['action'] == 'delete' && $_GET['status'] == 'OK')
            echo "<h5 class='error' style='color:green'>L'utilisateur a bien été supprimé !";
          if ($_GET['action'] == 'delete' && $_GET['status'] == 'KO')
              echo "<h5 class='error'>Une erreur est survenue durant la suppression !";
        }
        ?>
      </div>
      <div class="adduser">
        <h1 class='indextxt'>Ajouter un utilisateur</h1>
        <form class="" action="admin_request.php" method="post">
          <input type="text" name="email" placeholder="Adresse email..." value="" required/>
          <input type="password" name="password" placeholder="Mot de Passe (6 caractères min.)..." value="" required/>
          <input type="password" name="passwordverif" placeholder="Mot de Passe (Vérification)..." value="" required/><br>
          Admin <input type="radio" name="admin" value="1" />
          Membre <input type="radio" name="admin" value="0" /><br>
          <input type="submit" name="submit" value="Créer l'utilisateur" />
        </form><?php
        if (isset($_GET['action']) && isset($_GET['status']))
        {
          if ($_GET['action'] == "adduser" && $_GET['status'] == "OK")
            echo "<h5 class='error' style='color:green'>L'utilisateur a bien été créé !";
          else if ($_GET['action'] == "adduser" && $_GET['status'] == "KO")
            echo "<h5 class='error'>Une erreur est survenue durant la création !";
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
