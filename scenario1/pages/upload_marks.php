<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>

<?php 

$uploaded = false;
$file = $app->request()->file('file');

if($file) {
    $uploadfile = '../public/uploads/' . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $uploadfile);
    $uploaded = true;
}

?>

<div class="container">

    
    <h1>Upload students marks</h1>
    <p>Upload a <code>.csv</code> file containing the marks of users.</p>

    <?php if($uploaded): ?>
        <div class="alert alert-success">
            Le fichier <code><?= $file['name'] ?></code> a été uploadé avec succès dans le répertoire <code>uploads</code>.
        </div>
    <?php endif; ?>

    <form action="" method="POST"  enctype="multipart/form-data" id="form">
        <input type="file" name="file" accept=".csv" id="file" required>
        <input type="submit" value="Valider" class="btn btn-primary">
    </form>

</div>

<script>

var form = document.querySelector('#form');
var fileInput = document.querySelector('#file');

form.addEventListener('submit', function(event) {
    file = fileInput.files[0];

    if (file.name.split('.').pop() !== 'csv') {
        event.preventDefault();
        alert('Invalid file');
    }
})
</script>

<?php include('layout/footer.php'); ?>