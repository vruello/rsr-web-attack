<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (!empty($_POST["MAX_FILE_SIZE"])) {
  	check_file($_FILES['file']);
  }
}

function check_file($file) {
  if ($file['error'] > 0) {
  	display_file_error($file['error']);
  } else if ($file['size'] > 1048576) {
    echo "<p style='color : red'>Erreur lors du téléversement du fichier : la taille du fichier doit être inférieur à 1Mo...</p>";
  } else {
  	$extensions_valides = array('pdf', 'jpg', 'jpeg', 'gif', 'png');
  	$extension_upload = strtolower(substr(strrchr($file['name'], '.')  ,1));
  	//faille file-inclusion
  	//if (in_array($extension_upload,$extensions_valides)) {upload($file, $extension_upload);} else {echo "<p style='color : red'>Erreur lors du téléversement du fichier : seulement les fichiers pdf, jpg,jpeg, gif et png peuvent être téléversés...</p>";}
  	upload($file, $extension_upload);
  }
}

function upload($file, $extension_upload) {
  $folder = "./upload/";
  $path = $folder . $file['name'];
  $resultat = move_uploaded_file($file['tmp_name'], $path);
  if ($resultat) {
  	echo "<p style='color : green'>Téléversement réussi ! Le fichier a été placé dans le dossier ./upload !</p>";
  } else {
    // debug : Est ce que le dossier existe? Est ce qu'il est accessible en écriture?
  	//if(is_dir($folder)){echo "oui1";}else{echo "non1";}
  	//if(is_writable($folder)){echo "oui2";}else{echo "non2";}
  	echo "<p style='color : red'>Erreur lors de l'enregistrement du fichier...</p>";
  }
}

function display_file_error($error) {
	switch ($error) {
		case 2:
			echo "<p style='color : red'>Erreur lors du téléversement du fichier : la taille du fichier doit être inférieur à 1Mo...</p>";
			break;
		case 4:
			echo "<p style='color : red'>Erreur lors du téléversement : aucun fichier n'a été téléchargé...</p>";
			break;
		case 7:
			echo "<p style='color : red'>Erreur lors de l'écriture du fichier...</p>";
			break;
		default:
			echo "<p style='color : red'>Erreur lors du téléversement du fichier...</p>";
			break;
	}
}

?>

