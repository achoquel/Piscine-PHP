<?php

class Jaime extends Lannister
{
  public function sleepWith($who)
  {
    if (is_a($who, 'Stark'))
      echo "Let's do this.\n";
    else if (is_a($who, 'Tyrion'))
      echo "Not even if I'm drunk !\n";
    else if (is_a($who, 'Cersei'))
      echo "With pleasure, but only in a tower in Winterfell, then.\n";
  }
}

?>
