<?php
  public static function genstring($size)
  {
    $string = '';
    for ($i = 0; $i < $size; $i++)
    {
      $string .= $i % 10;
    }
    return $string;
  }
  $redis = new Redis();
  $redis->connect($_SERVER['CACHE2_HOST'], $_SERVER['CACHE2_PORT']);
  for($i = 64; $i < 4096; $i *= 2)
  {
    $in = genstring($i);
    $redis->set("test".$size, $in);
    $out = $redis->get("test".$size);
    if ($in == $out)
    {
      echo "$i match - $in - $out";
    }
    else
    {
      echo "$i don't match - $in - $out";
    }
  }
  $redis->set("test".$size, )
  $redis->close();
?>