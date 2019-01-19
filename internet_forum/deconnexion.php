<?php

session_start();

if (isset ($_COOKIE['cookie'])) {
	setcookie('cookie', '', -1);
}

session_destroy();
header("Location: index.php");

?>
