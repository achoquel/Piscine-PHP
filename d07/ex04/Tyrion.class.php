<?php

class Tyrion extends Lannister
{
  public function sleepWith($who)
  {
    if (is_a($who, 'Lannister'))
      echo "Not even if I'm drunk !\n";
    else
      echo "Let's do this.\n";
  }
}

?>
