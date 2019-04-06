<?php
$user = "zaz";
$pw = "jaimelespetitsponeys";
if (!(isset($_SERVER['PHP_AUTH_USER'])))
{
  header("WWW-Authenticate: Basic realm==''Espace membres''");
  header('HTTP/1.0 401 Unauthorized');
?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?php
}
 else
 {
   if ((isset($_SERVER['PHP_AUTH_USER']) && ($_SERVER['PHP_AUTH_USER'] === $user)) && (isset($_SERVER['PHP_AUTH_PW']) && ($_SERVER['PHP_AUTH_PW'] === $pw)))
   {
?>
<html><body>
Bonjour Zaz<br />
<?php
$img = base64_encode(file_get_contents('../img/42.png'));
echo "<img src='data:image/png;base64,$img'>\n";
?>
</body></html>
<?php
   }
   else {
     header("WWW-Authenticate: Basic realm==''Espace membres''");
     header('HTTP/1.0 401 Unauthorized');
?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?php
   }
 }
?>
