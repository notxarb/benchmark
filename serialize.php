<?php
$array = array(1,2,3,"Hello World!");
$serialized = serialize($array);
echo $serialized;
echo ($array == unserialize($serialized));
?>