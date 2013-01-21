<?php
  $myFile = "/var/srv/blah";
  $fh = fopen($myFile, 'w') or die("can't open file");
  $stringData = "Test Succeeded";
  fwrite($fh, $stringData);
  fclose($fh);
?>