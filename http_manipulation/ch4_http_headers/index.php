<?php

$FLAG = "A_D_M_I_N";

header("admin: false");

if ($_SERVER['HTTP_ADMIN'] == "true"){
	echo "Bravo ! Le flag est: " . $FLAG;
} else{
	echo "Tu n'es pas admin !";
}

?>