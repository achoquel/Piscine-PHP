<?php

class Vector
{
  private $_x = 0;
  private $_y = 0;
  private $_z = 0;
  private $_w = 0;
  public static $verbose = FALSE;

  function __construct(array $kwargs)
  {
    if (array_key_exists('dest', $kwargs))
    {
      if (array_key_exists('orig', $kwargs))
      {
        (float)$this->_x = (float)$kwargs['dest']->getX() -  (float)$kwargs['orig']->getX();
        (float)$this->_y = (float)$kwargs['dest']->getY() - (float)$kwargs['orig']->getY();
        (float)$this->_z = (float)$kwargs['dest']->getZ() - (float)$kwargs['orig']->getZ();
        (float)$this->_w = (float)$kwargs['dest']->getW() - (float)$kwargs['orig']->getW();
      }
      else
      {
        (float)$this->_x = (float)$kwargs['dest']->getX();
        (float)$this->_y = (float)$kwargs['dest']->getY();
        (float)$this->_z = (float)$kwargs['dest']->getZ();
        (float)$this->_w = (float)$kwargs['dest']->getW() - (float)1;
      }
    }

    if (self::$verbose == TRUE)
      printf("Vector( x: %.2F, y: %.2F, z:%.2F, w:%.2F ) constructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w);
    return;
  }

  function getX()
  {
    return $this->_x;
  }

  function getY()
  {
    return $this->_y;
  }

  function getZ()
  {
    return $this->_z;
  }

  function getW()
  {
    return $this->_w;
  }

  static function doc()
  {
    $doc = file_get_contents('Vector.doc.txt');
    echo $doc;
  }

  function magnitude()
  {
    return (sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z + $this->_w * $this->_w));
  }

  function normalize()
  {
    //    1     ->
    //    _   * V
    //  ||v||
    $tmpnorm = $this->magnitude();
    if ($tmpnorm == 1)
      return new Vector(array('dest' => new Vertex(array('x' => $this->_x, 'y' => $this->_y, 'z' => $this->_z, 'w' => $this->_w))));
    else {
      $tmp_x = ($this->_x/$tmpnorm);
      $tmp_y = ($this->_y/$tmpnorm);
      $tmp_z = ($this->_z/$tmpnorm);
      $tmp_w = ($this->_w/$tmpnorm);
      return new Vector(array('dest' => new Vertex(array('x' => $tmp_x, 'y' => $tmp_y, 'z' => $tmp_z, 'w' => $tmp_w))));
    }
  }

  function add($rhs)
  {
    $v2x = $rhs->getX();
    $v2y = $rhs->getY();
    $v2z = $rhs->getZ();
    $v2w = $rhs->getW();
    $tmp_x = $this->_x + $v2x;
    $tmp_y = $this->_y + $v2y;
    $tmp_z = $this->_z + $v2z;
    $tmp_w = $this->_w + $v2w;
    return new Vector(array('dest' => new Vertex(array('x' => $tmp_x, 'y' => $tmp_y, 'z' => $tmp_z, 'w' => $tmp_w))));
  }

  function sub($rhs)
  {
    $v2x = $rhs->getX();
    $v2y = $rhs->getY();
    $v2z = $rhs->getZ();
    $v2w = $rhs->getW();
    $tmp_x = $this->_x - $v2x;
    $tmp_y = $this->_y - $v2y;
    $tmp_z = $this->_z - $v2z;
    $tmp_w = $this->_w - $v2w;
    return new Vector(array('dest' => new Vertex(array('x' => $tmp_x, 'y' => $tmp_y, 'z' => $tmp_z, 'w' => $tmp_w))));
  }

  function opposite()
  {
    return new Vector(array('dest' => new Vertex(array('x' => -$this->_x, 'y' => -$this->_y, 'z' => -$this->_z, 'w' => -$this->_w))));
  }

  function scalarProduct($k)
  {
    return new Vector(array('dest' => new Vertex(array('x' => $k * $this->_x, 'y' => $k * $this->_y, 'z' => $k * $this->_z, 'w' => $k * $this->_w))));
  }

  function dotProduct($rhs)
  {
    $v2x = $rhs->getX();
    $v2y = $rhs->getY();
    $v2z = $rhs->getZ();
    $v2w = $rhs->getW();
    return ($this->_x * $v2x + $this->_y * $v2y + $this->_z * $v2z + $this->_w * $v2w);

  }

  function cos($rhs)
  {
    //             ->  ->
    //            (u . v)
    //  cos(u,v) = --------------
    //            (||u||.||v||)
    $scal = $this->dotProduct($rhs);
    $norm1 = $this->magnitude();
    $norm2 = $rhs->magnitude();
    return (($scal) / ($norm1 * $norm2));
  }

  function crossProduct($rhs)
  {
    $v2x = $rhs->getX();
    $v2y = $rhs->getY();
    $v2z = $rhs->getZ();
    $tmp_x = ($this->_y * $v2z) - ($this->_z * $v2y);
    $tmp_y = ($this->_z * $v2x) - ($this->_x * $v2z);
    $tmp_z = ($this->_x * $v2y) - ($this->_y * $v2x);
    return new Vector(array('dest' => new Vertex(array('x' =>  $tmp_x, 'y' => $tmp_y, 'z' => $tmp_z))));
  }

  function __toString()
  {
    $to_print = (string)'Vector( x: '.number_format($this->_x, 2, '.', '').', y: '.number_format($this->_y, 2, '.', '').', z:'.number_format($this->_z, 2, '.', '').', w:'.number_format($this->_w, 2, '.', '').' )';
    return $to_print;
  }

  function __destruct()
  {
    if (self::$verbose == TRUE)
      printf("Vector( x: %.2F, y: %.2F, z:%.2F, w:%.2F ) destructed".PHP_EOL, $this->_x, $this->_y, $this->_z, $this->_w);
    return;
  }
}

?>
