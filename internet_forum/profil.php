<?php
$pagetitle="profil";
include "header.php";

include "controller/report.php";
include "controller/upload.php";
?>

<h2>Votre profil</h2>

<?php

	if ($id != 0) {
		echo "<h3>Pseudo</h3><p>" . $pseudo . "</p>";
	}

?>

<h3>Rang</h3>

<?php

	if ($lvl == 1) {
		echo '<p style="color: blue;">utilisateur</p>';
	} else if ($lvl == 2) {
		echo '<p style="color: green;">modérateur</p>';
	} else if ($lvl == 3) {
		echo '<p style="color: red;">administrateur</p>';
	} else {
		echo '<p style="color: black;">invité</p>';
	}
	
?>

<h3>Description</h3> 

<?php

	if ($lvl == 1) {
		echo "<p>Vous êtes actuellement inscrit sur le site d'entrainement aux attaques web. Vous pouvez consulter les message du forum et en poster de nouveaux. Merci de rester courtois et respecteux !</p>";
	} else if ($lvl == 2) {
		echo "<p>Vous êtes actuellement modérateur du forum. Vous pouvez signalez des utilisateurs du forum si ces derniers se sont montrés irrespecteux. L'administrateur sera informé des alertes, et prendra la décision d'exclure l'utilisateur de la communauté du site ou non.</p>";
	} else if ($lvl == 3) {
		echo "<p>Vous êtes actuellement administrateur du forum. Vous pouvez promouvoir un utilisateur en tant que modérateur, ou bannir les utilisateurs signalés comme étant irrespecteux.</p>";
	} else {
		echo "<p>Bienvenue sur le site d'entrainement aux attaques web. Vous êtes actuellement un simple visiteur. Vous pouvez lire les différents posts du forum, mais vous ne pouvez pas écrire de nouveaux messages. Vous pourrez cependant le faire une fois inscrit et conencté !</p>";
	}
	
?>

<?php

if ($lvl == 2 || $lvl == 3) {
	echo "<br><h3>Signaler un utilisateur</h3><br>";
	echo "
	<form method='post'>
    	<div class='form-group'>
    		<label for='Username'>Nom d'utilisateur</label>
    		<input type='text' name='username' class='form-control' id='Username' aria-describedby='emailHelp' placeholder='Utilisateur à signaler' style='width: 350px;''>
    		<span class='error'>" . $usernameErr . "</span>
  		</div>
  		<button type='submit' class='btn btn-primary'>Signaler</button>
	</form><br>";
}

?>

<?php

if ($lvl == 3) {
	echo "<h3>Téléverser un fichier</h3><br>";
	echo "
	<form method='post' enctype='multipart/form-data'>
		<div class='form-group'>
		    <input type='hidden' name='MAX_FILE_SIZE' value='1048576' />
			<input type='file' name='file' />
		</div>
		<button type='submit' class='btn btn-primary'>Téléverser</button>
	</form><br>";
}

?>

<?php include "footer.php" ?>