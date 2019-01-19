<?php
$pagetitle="documents";
include "header.php";

include "controller/documents.php";
?>

<style type="text/css">
.btn-download {
  background-color: #ffc945;
  border: none;
  color: white;
  padding: 6px 15px;
  margin: 10px 20px;
  cursor: pointer;
  font-size: 15px;
}

/* Darker background on mouse-over */
.btn-download:hover {
  background-color: #ffea82;
}	

</style>

<h2>Documents</h2>

<p>
Voici une liste de documents que vous pouvez télécharger et consulter gratuitement, pour votre culture personnelle !
</p>
<br>

<?php
  list_documents();
?>



<?php include "footer.php" ?>