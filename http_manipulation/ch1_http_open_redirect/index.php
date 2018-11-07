<?php

$FLAG = "HtTp_HeAdEr_FlAg";

if (isset($_GET['url']) && isset($_GET['h']) && sha1($_GET['url']) == $_GET['h']){

	if ($_GET['url'] != "https://eirb.fr"){
		echo "Bravo ! Le flag est " . $FLAG;
	}

	echo "<script>document.location = '" . $_GET['url'] . "';</script>";
	
} else{
    echo "<a href='?url=https://eirb.fr&h=c11871ab348e35969c3e0339f5a89aca7a12b0a5'>Eirb</a>";
}

?>