<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';
require_once 'Vector.class.php';

class Matrix
{
  const IDENTITY = '0';
  const SCALE = '1';
  const RX = '2';
  const RY = '3';
  const RZ = '4';
  const TRANSLATION = '5';
  const PROJECTION = '6';
  private $_matrix;
  public static $verbose = FALSE;

  function cot($v)
  {
    return cos(deg2rad($v))/sin(deg2rad($v));

  }

  function __construct($kwargs)
  {
    if (array_key_exists('preset', $kwargs))
    {
      if ($kwargs['preset'] == self::IDENTITY)
      {
        $this->_matrix = array(array('1.0', '0.0', '0.0', '0.0'),
                              array('0.0', '1.0', '0.0', '0.0'),
                              array('0.0', '0.0', '1.0', '0.0'),
                              array('0.0', '0.0', '0.0', '1.0'));
        if (self::$verbose === TRUE)
         {
          print("Matrix IDENTITY instance constructed".PHP_EOL);
         }
      }
      else if ($kwargs['preset'] == self::SCALE && array_key_exists('scale', $kwargs))
      {
        $this->_matrix = array(array($kwargs['scale'], '0.0', '0.0', '0.0'),
                              array('0.0', $kwargs['scale'], '0.0', '0.0'),
                              array('0.0', '0.0', $kwargs['scale'], '0.0'),
                              array('0.0', '0.0', '0.0', '1.0'));
        if (self::$verbose === TRUE)
        {
          print("Matrix SCALE preset instance constructed".PHP_EOL);
        }
      }
      else if ($kwargs['preset'] == self::RX && array_key_exists('angle', $kwargs))
      {
        $this->_matrix = array(array('1.0', '0.0', '0.0', '0.0'),
                               array('0.0', cos($kwargs['angle']), -sin($kwargs['angle']), '0.0'),
                               array('0.0', sin($kwargs['angle']), cos($kwargs['angle']), '0.0'),
                               array('0.0', '0.0', '0.0', '1.0'));
        if (self::$verbose === TRUE)
        {
          print("Matrix Ox ROTATION preset instance constructed".PHP_EOL);
        }
      }
      else if ($kwargs['preset'] == self::RY && array_key_exists('angle', $kwargs))
      {
        $this->_matrix = array(array(cos($kwargs['angle']), '0.0', sin($kwargs['angle']), '0.0'),
                              array('0.0', '1.0', '0.0', '0.0'),
                              array(-sin($kwargs['angle']), '0.0', cos($kwargs['angle']), '0.0'),
                              array('0.0', '0.0', '0.0', '1.0'));
        if (self::$verbose === TRUE)
        {
          print("Matrix Oy ROTATION preset instance constructed".PHP_EOL);
        }
      }
      else if ($kwargs['preset'] == self::RZ && array_key_exists('angle', $kwargs))
      {
        $this->_matrix = array(array(cos($kwargs['angle']), -sin($kwargs['angle']), '0.0', '0.0'),
                              array(sin($kwargs['angle']), cos($kwargs['angle']), '0.0', '0.0'),
                              array('0.0', '0.0', '1.0', '0.0'),
                              array('0.0', '0.0', '0.0', '1.0'));
        if (self::$verbose === TRUE)
        {
          print("Matrix Oz ROTATION preset instance constructed".PHP_EOL);
        }
      }
      else if ($kwargs['preset'] == self::TRANSLATION && array_key_exists('vtc', $kwargs))
      {
        $this->_matrix = array(array(1.0, 0.0, 0.0, 0.0),
                              array(0.0, 1.0, 0.0, 0.0),
                              array(0.0, 0.0, 1.0, 0.0),
                              array(0.0, 0.0, 0.0, 1.0));
        (float)$this->_matrix['0']['3'] += (float)$kwargs['vtc']->getX();
        (float)$this->_matrix['1']['3'] += (float)$kwargs['vtc']->getY();
        (float)$this->_matrix['2']['3'] += (float)$kwargs['vtc']->getZ();
        if (self::$verbose === TRUE)
        {
          print("Matrix TRANSLATION preset instance constructed".PHP_EOL);
        }
      }
      else if ($kwargs['preset'] == self::PROJECTION && array_key_exists('fov', $kwargs) && array_key_exists('ratio', $kwargs) && array_key_exists('near', $kwargs) && array_key_exists('far', $kwargs))
      {
        $this->_matrix = array(array($this->cot($kwargs['fov']/2)/$kwargs['ratio'], 0.0, 0.0, 0.0),
                               array(0.0, $this->cot($kwargs['fov']/2), 0.0, 0.0),
                               array(0.0, 0.0, -(($kwargs['far'] + $kwargs['near'])/($kwargs['far'] - $kwargs['near'])), -((2 * $kwargs['far'] * $kwargs['near'])/($kwargs['far'] - $kwargs['near']))),
                               array(0.0, 0.0, -1.0, 0.0));
        if (self::$verbose === TRUE)
        {
          print("Matrix PROJECTION preset instance constructed".PHP_EOL);
        }
      }
    }
    return;
  }

  static function doc()
  {
    $doc = file_get_contents('Matrix.doc.txt');
    echo $doc;
  }

  function mult($rhs)
  {
    $new_matrix = clone $rhs;
    $N = 4;
    for ($i = 0; $i < $N; $i++)
    {
        for ($j = 0; $j < $N; $j++)
        {
            $res[$i][$j] = 0;
            for ($k = 0; $k < $N; $k++)
                $res[$i][$j] += $this->_matrix[$i][$k] *
                                $rhs->_matrix[$k][$j];
        }
    }
    $new_matrix->_matrix = $res;
    return $new_matrix;
  }

  function transformVertex($vtx)
  {
    $x = $this->_matrix['0']['0'] * $vtx->getX() + $this->_matrix['0']['1'] * $vtx->getY() + $this->_matrix['0']['2'] * $vtx->getZ() + $this->_matrix['0']['3'] * $vtx->getW();
    $y = $this->_matrix['1']['0'] * $vtx->getX() + $this->_matrix['1']['1'] * $vtx->getY() + $this->_matrix['1']['2'] * $vtx->getZ() + $this->_matrix['1']['3'] * $vtx->getW();
    $z = $this->_matrix['2']['0'] * $vtx->getX() + $this->_matrix['2']['1'] * $vtx->getY() + $this->_matrix['2']['2'] * $vtx->getZ() + $this->_matrix['2']['3'] * $vtx->getW();
    $w = $this->_matrix['3']['0'] * $vtx->getX() + $this->_matrix['3']['1'] * $vtx->getY() + $this->_matrix['3']['2'] * $vtx->getZ() + $this->_matrix['3']['3'] * $vtx->getW();
    return new Vertex(array('x' => $x, 'y' => $y, 'z' => $z, 'w' => $w));
  }

  function __toString()
  {
    $toprint = "M | vtcX | vtcY | vtcZ | vtxO".PHP_EOL.
               "-----------------------------".PHP_EOL.
               "x | ".number_format($this->_matrix['0']['0'], 2, '.', '')." | ".number_format($this->_matrix['0']['1'], 2, '.', '')." | ".number_format($this->_matrix['0']['2'], 2, '.', '')." | ".number_format($this->_matrix['0']['3'], 2, '.', '').PHP_EOL.
               "y | ".number_format($this->_matrix['1']['0'], 2, '.', '')." | ".number_format($this->_matrix['1']['1'], 2, '.', '')." | ".number_format($this->_matrix['1']['2'], 2, '.', '')." | ".number_format($this->_matrix['1']['3'], 2, '.', '').PHP_EOL.
               "z | ".number_format($this->_matrix['2']['0'], 2, '.', '')." | ".number_format($this->_matrix['2']['1'], 2, '.', '')." | ".number_format($this->_matrix['2']['2'], 2, '.', '')." | ".number_format($this->_matrix['2']['3'], 2, '.', '').PHP_EOL.
               "w | ".number_format($this->_matrix['3']['0'], 2, '.', '')." | ".number_format($this->_matrix['3']['1'], 2, '.', '')." | ".number_format($this->_matrix['3']['2'], 2, '.', '')." | ".number_format($this->_matrix['3']['3'], 2, '.', '');
    return $toprint;
  }

  function __destruct()
  {
    if (self::$verbose === TRUE)
    {
      print('Matrix instance destructed'.PHP_EOL);
    }
    return;
  }
}









?>
