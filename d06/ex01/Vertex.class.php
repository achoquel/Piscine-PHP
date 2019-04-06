<?php

require_once 'Color.class.php';

class Vertex
{
  private $_x = 0.00;
  private $_y = 0.00;
  private $_z = 0.00;
  private $_w = 1.00;
  private $_color = 0;
  public static $verbose = FALSE;

  function __construct(array $kwargs)
  {
    if (array_key_exists('x', $kwargs) && array_key_exists('y', $kwargs) && array_key_exists('z', $kwargs))
    {
      (float)$this->_x = $kwargs['x'];
      (float)$this->_y = $kwargs['y'];
      (float)$this->_z = $kwargs['z'];
      if (array_key_exists('w', $kwargs))
        $this->_w = $kwargs['w'];
      if (array_key_exists('color', $kwargs))
        $this->_color = $kwargs['color'];
      else
        $this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
    }
    if (self::$verbose === TRUE)
      printf("Vertex( x: %.2F, y: %.2F, z:%.2F, w:%.2F, ".$this->_color." ) constructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w);
    return;
  }

  static function doc()
  {
    $doc = file_get_contents('Vertex.doc.txt');
    echo $doc;
  }

  function getX()
  {
    return $this->_x;
  }

  function setX($value)
  {
    $this->_x = $value;
    return;
  }

  function getY()
  {
    return $this->_y;
  }

  function setY($value)
  {
    $this->_y = $value;
    return;
  }

  function getZ()
  {
    return $this->_z;
  }

  function setZ($value)
  {
    $this->_z = $value;
    return;
  }

  function getW()
  {
    return $this->_w;
  }

  function setW($value)
  {
    $this->_w = $value;
    return;
  }

  function getColor()
  {
    return $this->_color;
  }

  function setColor($value)
  {
    $this->_color = $value;
    return;
  }

  function __toString()
  {
    if (self::$verbose === TRUE)
      $to_print = (string)'Vertex( x: '.number_format($this->_x, 2, '.', '').', y: '.number_format($this->_y, 2, '.', '').', z:'.number_format($this->_z, 2, '.', '').', w:'.number_format($this->_w, 2, '.', '').', '.$this->_color.' )';
    else if (self::$verbose === FALSE)
      $to_print = (string)'Vertex( x: '.number_format($this->_x, 2, '.', '').', y: '.number_format($this->_y, 2, '.', '').', z:'.number_format($this->_z, 2, '.', '').', w:'.number_format($this->_w, 2, '.', '').' )';
    return $to_print;
  }

  function __destruct()
  {
    if (self::$verbose === TRUE)
      printf("Vertex( x: %.2F, y: %.2F, z:%.2F, w:%.2F, ".$this->_color." ) destructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w);
    return;
  }
}
?>
