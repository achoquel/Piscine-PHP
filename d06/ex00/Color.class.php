<?php

class Color
{
  public $red = 0;
  public $green = 0;
  public $blue = 0;
  public static $verbose = False;

  function __construct(array $kwargs)
  {
    if (array_key_exists('rgb', $kwargs))
    {
      settype($kwargs['rgb'], 'integer');
      $this->red = ($kwargs['rgb'] / (256 * 256)) % 256;
      $this->green = ($kwargs['rgb'] / 256) % 256;
      $this->blue = $kwargs['rgb'] % 256;
    }
    else if (!array_key_exists('rgb', $kwargs))
    {
      if (array_key_exists('red', $kwargs))
      {
        settype($kwargs['red'], 'integer');
        if ($kwargs['red'] <= 255 && $kwargs['red'] >= 0)
          $this->red = $kwargs['red'];
        else if ($kwargs['red'] > 255)
          $this->red = 255;
        else if ($kwargs['red'] < 0)
          $this->red = 0;
      }
      if (array_key_exists('green', $kwargs))
      {
        settype($kwargs['green'], 'integer');
        if ($kwargs['green'] <= 255 && $kwargs['green'] >= 0)
          $this->green = $kwargs['green'];
        else if ($kwargs['green'] > 255)
          $this->green = 255;
        else if ($kwargs['green'] < 0)
          $this->green = 0;
      }
      if (array_key_exists('blue', $kwargs))
      {
        settype($kwargs['blue'], 'integer');
        if ($kwargs['blue'] <= 255 && $kwargs['blue'] >= 0)
          $this->blue = $kwargs['blue'];
        else if ($kwargs['blue'] > 255)
          $this->blue = 255;
        else if ($kwargs['blue'] < 0)
          $this->blue = 0;
      }
    }
    if (self::$verbose === TRUE)
      print('Color( red: '.$this->red.', green: '.$this->green.', blue: '.$this->blue.' ) constructed.'.PHP_EOL);
    return;
  }

  static function doc()
  {
    $doc = file_get_contents('Color.doc.txt');
    echo $doc;
  }

  function add(Color $rhs)
  {
      $tmpred = $this->red + $rhs->red;
      $tmpgreen = $this->green + $rhs->green;
      $tmpblue = $this->blue + $rhs->blue;
    return (new Color(array('red' => $tmpred , 'green' => $tmpgreen, 'blue' => $tmpblue)));
  }

  function sub(Color $arg)
  {
    $tmpred = $this->red - $arg->red;
    $tmpgreen = $this->green - $arg->green;
    $tmpblue = $this->blue - $arg->blue;
    return (new Color(array('red' => $tmpred , 'green' => $tmpgreen, 'blue' => $tmpblue)));
  }

  function mult($f)
  {
    $tmpred = $this->red * $f;
    $tmpgreen = $this->green * $f;
    $tmpblue = $this->blue * $f;
    return (new Color(array('red' => $tmpred , 'green' => $tmpgreen, 'blue' => $tmpblue)));
  }

  function __toString()
  {
    $to_print = (string)'Color( red: '.$this->red.', green: '.$this->green.', blue: '.$this->blue.' )';
    return $to_print;
  }

  function __destruct()
  {
    if (self::$verbose === TRUE)
      print('Color( red: '.$this->red.', green: '.$this->green.', blue: '.$this->blue.' ) destructed.'.PHP_EOL);
    return;
  }
}
?>
