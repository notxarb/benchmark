<?php

// yeah... we know :-O This is a dummy app, cut some slack

$noDatabase = true;
if (isset($_SERVER['CACHE2_HOST']) && isset($_SERVER['CACHE2_PORT'])) {
  $r = new Redis();
  $r->connect($_SERVER['CACHE2_HOST'], $_SERVER['CACHE2_PORT']);
  if (!$r) {
    $noDatabase = true;
    die('Could not connect');
  }
  else
  {
    $noDatabase = false;
  }


  if (isset($_POST['Content'])) {
    // Drop key if content is 'bobby"; drop tables;'
    if (strcmp($_POST['Content'], 'bobby"; drop tables;') == 0)
    {
      $r->delete("messages")
    }
    else
    {
      if ($content = $_POST['Content']) {
        $words = str_word_count($content);
        $blah = str_repeat("blah ", $words);
        $r->lPush("messages", $blah);
      }
    }
  }
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>Pagoda Message App</title>
  <link rel="stylesheet" type="text/css" href="css/layout.css" media="all" />
  <script type="text/javascript" src="http://use.typekit.com/hai1jyh.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>
  <div class="wrapper">
    <div class="content">
      <? if ($noDatabase): ?>
        <div class="moon"></div>
        <div class="box">
          <p>We were unable to locate your database. You can create one in your <a href="http://dashboard.pagodabox.com" target="_blank">admin panel</a>, then simply set the following global vars to your database’s credentials. You do so via the <a href="http://guides.pagodabox.com/images/misc-demos/global-vars.png" target="_blank">Global Vars</a> tab in the admin panel:</p>
          <p class="indent">db_name = &lsaquo;your-db-name&rsaquo;</p>
          <p class="indent">db_host = &lsaquo;your-db-host&rsaquo;</p>
          <p class="indent">db_user = &lsaquo;your-db-user&rsaquo;</p>
          <p class="indent">db_pass = &lsaquo;your-db-password&rsaquo;</p>
          <p>No need to move in haste, the universe is patient.</p>
        </div>
      <? else: ?>
        <form action="speakredis.php" method="post">
          <div class="border">
            <input type="text" name="Content" class="textarea" />
          </div>
          <input class="btn" type="image" value="" src="images/btn.png" border="0" name="btn">
          <div class="message-box">
            <?          
            $cssClass  = array("yellow", "orange");
            $valAr = $r->lRange('message', 0, -1);

            // Reverse array and print values as html
            $len = count($valAr);
            for ($i = 0; $i < $len; $i++) { 
              echo  "<div class='message " . $cssClass[$i % (count($cssClass))] . "'>";
              echo  "  <span class='top'></span>";
              echo  $valAr[$i];
              echo  "  <span class='bottom'></span>";
              echo  "</div>";
            }
            ?>
          </div>
        </form>
      <? endif ?>
    </div>
  </div>
</body>
</html>