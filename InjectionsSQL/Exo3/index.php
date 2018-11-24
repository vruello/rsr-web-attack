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
    //echo $sql;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $keys = array_keys($row);

    if(mysqli_num_rows($result) == 1)
    {
        echo "<p><font color='red'>Utilisé</font></p>";
    }
    else
    {
        echo "<p><font color='green'>Libre</font></p>";
    }
}
?>


<h3>Vérifier si un identifiant est déjà utilisé</h3>

<form action="" method="get">
    ID de l'utilisateur
    <br>
    <input type="number" name="id">
    <input type="submit" value="Chercher">
</form>

<br><br>
<h4>Indications</h4>

<p>
La table "users" contient les champs "id", "username" et "password".
</p>

</body>

</html>