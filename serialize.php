<?php
$array = array(1,2,3,"Hello World!");
$serialized = serialize($array);
echo $serialized;
echo "Unserialize".($array == unserialize($serialized));

$redis = new Redis();
$redis->connect($_SERVER['CACHE2_HOST'], $_SERVER['CACHE2_PORT']);
$redis->set('array', $array);
$redis->set('serialized', $serialized);
echo "Array".($array == $redis->get('array'));
print_r( $redis->get('array'));
echo "Serialized".($array == unserialize($redis->get('serialized')));
?>