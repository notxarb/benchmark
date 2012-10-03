<?php
  function genstring($size)
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
    $redis->set("test".$i, $in);
    $out = $redis->get("test".$i);
    if ($in == $out)
    {
      echo "$i match - $in - $out<br />";
    }
    else
    {
      echo "$i don't match - $in - $out<br />";
    }
  }
  $redis->close();
?>