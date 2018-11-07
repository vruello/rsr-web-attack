<?php

header('WWW-Authenticate: Basic realm="My Realm"');

$FLAG = "R000T";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'GET'){
	echo "Bravo! Le flag est: " . $FLAG;
} else{
	echo "Authentification requise...";
}

?>