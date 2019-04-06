<?php
include('connexion_sql.php');
session_start();
if ($_POST['submit'] === "S'inscrire")
{
  if ($db = connect_db())
  {
    $pass = hash("whirlpool", mysqli_real_escape_string($db, $_POST['password']));
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $birthday = mysqli_real_escape_string($db, $_POST['birthday']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $postal = mysqli_real_escape_string($db, $_POST['postal']);
    $country = mysqli_real_escape_string($db, $_POST['country']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $q = "INSERT INTO user (lastname, firstname, birthday, email, phone, address, city, country, postal, password, admin) VALUES ($lastname, $firstname, $birthday, $email, $phone, $address, $city, $country, $postal, $password, 0)";
    $res = mysqli_query($db, $q);
    mysqli_free_result($res);
  }
  header("Refresh: 0; URL=register_.php?status=OK");
}
?>
