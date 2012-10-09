<?php
$array = array(1,2,3,"Hello World!");
$serialized = serialize($array);
echo $serialized;
echo ($array == unserialize($serialized));

$redis = new Redis();
$redis->connect($_SERVER['CACHE2_HOST'], $_SERVER['CACHE2_PORT']);
$redis->set('array', $array);
$redis->set('serialized', $serialized);
echo ($array == $redis->get('array'));
echo ($array == unserialize($redis->get('serialized')));
?>