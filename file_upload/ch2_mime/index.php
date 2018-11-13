<form action="" method="post" enctype="multipart/form-data">
    Select image to upload (jpeg, gif or png only accepted):<br/>
    <input type="file" name="file" id="file">
    <input type="submit" value="Upload Image" name="submit">
</form>


<?php

$FLAG = "Welll_dooone_123*";

if(isset($_POST["submit"]) && isset($_FILES["file"])){
	$newName = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	$path = "uploads";
	$legalTypes = array("image/gif", "image/jpeg", "image/png");
	$legalSize = "10000000"; // 10000000 Octets = 10 MO
	$ultimatePath = $path . '/' . $newName . '/' . $_FILES["file"]["name"];

    if (!file_exists($path)) {
        mkdir($path, 0750);
    }

	if (!file_exists($path . '/' . $newName)) {
    	mkdir($path . '/' . $newName, 0750);
	}

    if ($_FILES["file"]["size"] < $legalSize) {
        if (in_array($_FILES["file"]["type"], $legalTypes)) {
            move_uploaded_file($_FILES["file"]["tmp_name"], $ultimatePath);
            echo "<img width=64px height=64px src='" . $ultimatePath . "'/>" ;
        } else{
        	echo "Wrong file type";
        }
    } else{
    	echo "File size too big";
    }
}

?>
