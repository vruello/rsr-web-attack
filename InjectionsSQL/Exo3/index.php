<?php

$dbname = "injectionSQL3";
$conn = new mysqli("localhost", "exo3", "mdpexo3", $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html>

<head></head>

<body>

<h1>Injection SQL : Exo3</h1>

<?php

if(!empty($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT id, username FROM users WHERE id=". $id . ";";
    echo $sql;
    $result = $conn->query($sql);
    //id=-1 UNION SELECT 1,2 FROM users WHERE 1=1

    if(mysqli_num_rows($result) == 1)
    {
        echo "<p><font color='red'>Utilisateur existant.</font></p>";
    }
    else
    {
        echo "<p><font color='green'>Utilisateur inexistant.</font></p>";
    }
}
?>


<h3>Types de projets</h3>

<form action="" method="get">
	Nom de l'utilisateur
	<br>
	<input type="text" name="id">
	<input type="submit" value="Vérifier">
</form>


</body>

</html>