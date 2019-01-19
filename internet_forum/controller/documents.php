<?php

function list_documents() {

  if ($dossier = opendir('./upload')) {
    echo '<ul>';
    
    while (false !== ($fichier = readdir($dossier))) {
      if ($fichier != '.' && $fichier != '..' && $fichier != "index.php") {
        echo '<li style="font-size: 20px;">' . $fichier . '<a download href="./upload/' . $fichier . '"><button class="btn btn-download"><i class="fa fa-download"></i>Télécharger</button></a></li>';
      }
    }

    echo '</ul><br>';
    closedir($dossier);
  } else {
    echo "<p style='color : red'>Erreur lors du chargement des documents...</p>";
  }


}

?>
