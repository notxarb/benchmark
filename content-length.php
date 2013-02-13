<?php 
  $top = "<html><head><title>Content length test</title></head><body>\n";
  $content = "<div>1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef1234567890abcdef</div>\n";
  $body = str_repeat($content, 128);
  $bottom = "</body></html>\n";
  $html = $top . $body . $bottom;
  header("Content-Length: " . strlen($html));
  echo $html;
?>