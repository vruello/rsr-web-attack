<?php
$FLAG = "UsEr_123_AgEnT";

if ($_SERVER['HTTP_USER_AGENT'] == "admin"){
	echo "Bravo! Le flag est: " . $FLAG;
} else{
	echo "You are not an admin...";
}


?>