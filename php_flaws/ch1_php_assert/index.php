<?php

if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $file = $page . ".php";

  assert("strpos('$file', '..') === false") or die("Too easy!");
  
  if(!file_exists($file)){
  	die ("File does not exist");
  }

} else {
  $file = "home.php";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Evilness is words to live by.</title>
  </head>
 <body>
    <div>
      <a href="?page=home">Home</a> |
      <a href="?page=about">About</a> |
      <a href="?page=contact">Contact</a>
    </div>

    <div>
      <?php
        include_once( $file );
      ?>
    </div>

  </body>
</html>