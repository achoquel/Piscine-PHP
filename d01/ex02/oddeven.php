#!/usr/bin/php
<?php
$file = fopen('php://stdin', 'r');
while (!feof($file))
{
  echo "Entrez un nombre: ";
  $answer = fread($file, 8192);
  $array = explode(": ", $answer);
  $array = explode("\n", $array[0]);
  if (is_numeric($array[0]))
  {
    if ($array[0] % 2 == 0)
      echo "Le chiffre $array[0] est Pair\n";
    else
      echo "Le chiffre $array[0] est Impair\n";
  }
  else if (!feof($file))
    echo "'$array[0]' n'est pas un chiffre\n";
}
echo "\n";
fclose($file);
?>
