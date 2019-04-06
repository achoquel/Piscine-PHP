#!/usr/bin/php
<?php

function get_paths($content, $url)
{
  preg_match_all('/<img.*src=.*/i', $content, $paths);
  $content = implode(" ", $paths[0]);
  preg_match_all('/src="([^"]+)"/i', $content, $paths);
  $img_paths = $paths[1];
  $i = 0;
  foreach ($img_paths as $elem)
  {
      if (preg_match('/^\//', $elem))
        $img_paths[$i] = $url.$img_paths[$i];
      ++$i;
  }
  return $img_paths;
}

function get_dir ($url)
{
  $dir = preg_replace('/(https:\/\/|http:\/\/)/i', '', $url);
  return $dir;
}

function get_name($path)
{
  $data = explode('/', $path);
  $size = count($data);
  return $data[$size - 1];
}

function get_content($address)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $address);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  $content = curl_exec($ch);
  curl_close($ch);
  return $content;
}

  $content = get_content($argv[1]);
  if ($content !== FALSE)
  {
    $img_paths = get_paths($content, $argv[1]);
    $img_content = array();
    $dir = get_dir($argv[1]);
    mkdir($dir);
    $i = 0;
    foreach($img_paths as $elem)
    {
      $img_content[$i] = get_content($elem);
      $path = $dir."/".get_name($elem);
      $fd = fopen($path, 'w+');
      fwrite($fd, $img_content[$i]);
      fclose($fd);
      ++$i;
    }
  }
  else
    echo "Web page doesn't exists !\n";
?>
