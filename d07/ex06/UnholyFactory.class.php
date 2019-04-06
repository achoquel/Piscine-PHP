<?php

class UnholyFactory
{
  private $_fs = 0;
  private $_arc = 0;
  private $_ass = 0;
  private $_lam = 0;

  public function absorb($type)
  {
    if (is_a($type, 'Fighter'))
    {
      if (is_a($type, 'Footsoldier') && $this->_fs == 0)
      {
        print("(Factory absorbed a fighter of type foot soldier)".PHP_EOL);
        $this->_fs = 1;
      }
      else if (is_a($type, 'Footsoldier') && $this->_fs == 1)
        print("(Factory already absorbed a fighter of type foot soldier)".PHP_EOL);
      if (is_a($type, 'Archer') && $this->_arc == 0)
      {
        print("(Factory absorbed a fighter of type archer)".PHP_EOL);
        $this->_arc = 1;
      }
      else if (is_a($type, 'Archer') && $this->_arc == 1)
        print("(Factory already absorbed a fighter of type archer)".PHP_EOL);
      if (is_a($type, 'Assassin') && $this->_ass == 0)
      {
        print("(Factory absorbed a fighter of type assassin)".PHP_EOL);
        $this->_ass = 1;
      }
      else if (is_a($type, 'Assassin') && $this->_ass == 1)
        print("(Factory already absorbed a fighter of type assassin)".PHP_EOL);
      if (is_a($type, 'Llama') && $this->_lam == 0)
      {
        print("(Factory absorbed a fighter of type llama)".PHP_EOL);
        $this->_lam = 1;
      }
      else if (is_a($type, 'Llama') && $this->_lam == 1)
        print("(Factory already absorbed a fighter of type llama)".PHP_EOL);
    }
    else
      print("(Factory can't absorb this, it's not a fighter)".PHP_EOL);
  }

  public function fabricate($type)
  {
    if ($type == "foot soldier" && $this->_fs == 1)
    {
      print("(Factory fabricates a fighter of type foot soldier)".PHP_EOL);
      return new Footsoldier;
    }
    else if ($type == 'foot soldier' && $this->_fs == 0)
      print("(Factory hasn't absorbed any fighter of type foot soldier)".PHP_EOL);
    if ($type == "archer" && $this->_arc == 1)
    {
      print("(Factory fabricates a fighter of type archer)".PHP_EOL);
      return new Archer;
    }
    else if ($type == 'archer' && $this->_arc == 0)
      print("(Factory hasn't absorbed any fighter of type archer)".PHP_EOL);
    if ($type == "assassin" && $this->_ass == 1)
    {
      print("(Factory fabricates a fighter of type assassin)".PHP_EOL);
      return new Assassin;
    }
    else if ($type == 'assassin' && $this->_ass == 0)
      print("(Factory hasn't absorbed any fighter of type assassin)".PHP_EOL);
    if ($type == "llama" && $this->_lam == 1)
    {
      print("(Factory fabricates a fighter of type llama)".PHP_EOL);
      return new Llama;
    }
      else if ($type == 'llama' && $this->_lam == 0)
        print("(Factory hasn't absorbed any fighter of type llama)".PHP_EOL);
  }
}
?>
