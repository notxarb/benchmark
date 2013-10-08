<?php
  $myFile = "/data/benchmark/testWrite.php";
  $fh = fopen($myFile, 'w') or die("can't open file");
  $stringData = "Test Succeeded";
  fwrite($fh, $stringData);
  fclose($fh);
?>
