<form action="" method="post" enctype="multipart/form-data">
    Select a zip to upload:<br/>
    <input type="file" name="file" id="file">
    <input type="submit" value="Upload Image" name="submit">
</form>


<?php

$FLAG = "Fl0g_R0_0_T";

if(isset($_POST["submit"]) && isset($_FILES["file"])){
	$newName = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	$path = "uploads";
	$legalExtensions = array("zip");
	$legalSize = "10000000"; // 10000000 Octets = 10 MO
	$extension =  strtolower(pathinfo( $_FILES["file"]['name'], PATHINFO_EXTENSION));
	$ultimatePath = $path . '/' . $newName . '/' . $_FILES["file"]["name"];

    if (!file_exists($path)) {
        mkdir($path, 0750);
    }

	if (!file_exists($path . '/' . $newName)) {
    	mkdir($path . '/' . $newName, 0750);
	}

    if ($_FILES["file"]["size"] < $legalSize) {
        if (in_array($extension, $legalExtensions)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], $ultimatePath);

            shell_exec('unzip -d ' . $path . '/' . $newName . ' ' . $ultimatePath ); 
            shell_exec('chmod 100 ' . str_replace(".zip", "", $ultimatePath) ); 

            echo "File upload successful <a href='" . $path . "/" . $newName . "'>Here</a" ;
        } else{
        	echo "Wrong file extension";
        }
    } else{
    	echo "File size too big";
    }
}

?>
