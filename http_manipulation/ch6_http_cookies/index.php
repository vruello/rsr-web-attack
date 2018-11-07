<?php
	$FLAG = "A-z_e$r)T+y";
	$admin = "admin";
	$visitor = "visitor";
	setcookie("c", $visitor);
?>

<form method="POST" action="">
  <input type="submit" value="Get flag">
</form> 

<?php

if ($_COOKIE['c'] === $admin){
	echo "Bravo! Le flag est: " . $FLAG;
} else{
	echo "Access  denied...";
}

?>