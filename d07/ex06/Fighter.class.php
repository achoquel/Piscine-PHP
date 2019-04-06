<?php

class Fighter
{
  function __construct($who)
  {
    if ($who != "foot soldier" && $who != "archer" && $who != "assassin" && $who != "llama")
      not_today_bro();
    else
      return;
  }
}


?>
