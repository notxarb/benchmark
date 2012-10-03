<?php
  function genstring($size)
  {
    $string = '';
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-=~!@#$%^&*()_+<>?/.,;:"{}[]';
    for ($i = 0; $i < $size; $i++)
    {
      $string .= substr($charset, rand(0,90), 1);
    }
    return $string;
  }
  $redis = new Redis();
  $redis->connect($_SERVER['CACHE2_HOST'], $_SERVER['CACHE2_PORT']);
  for($i = 64; $i < 65536; $i *= 2)
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