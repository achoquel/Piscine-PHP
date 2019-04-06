<?php

class NightsWatch
{
  private $_fighters;

  public function __construct()
  {
    $_fighters = array();
  }
  public function recruit($who)
  {
    if (is_a($who, 'IFighter'))
      $this->_fighters[] = $who;
  }
  public function fight()
  {
    foreach($this->_fighters as $key => $value)
      $value->fight();
  }
}

?>
