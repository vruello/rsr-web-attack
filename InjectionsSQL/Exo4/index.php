<?php

$dbname = "injectionSQL4";
$conn = new mysqli("localhost", "exo4", "mdpexo4", $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html>

<head></head>

<body>

<h1>Injection SQL : Exo4</h1>

<?php

if(!empty($_GET['projet']))
{
    $projet = mysqli_real_escape_string($conn, $_GET['projet']);
    $sql = "SELECT projets.id AS id, projets.title AS projet, DATE_FORMAT(date, '%d/%m/%Y') AS date, categories.title AS category FROM projets INNER JOIN categories ON projets.category_id = categories.id WHERE projets.id = ". $projet;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(mysqli_num_rows($result) == 1){
        echo "<h3>Information sur le projet <u>" . $row['projet'] . "</u></h3><ul>";

        echo "<li>Id : " . $row['id'] . "</li>";
        echo "<li>Date : " . $row['date'] . "</li>";
        echo "<li>Categorie : " . $row['category'] . "</li>";

        echo "</ul>";
    }
}

?>


<h3>Liste des projets</h3>

<?php

$sql = "SELECT id, title FROM projets;";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $keys = array_keys($row);   
    echo "<a href='?projet=" . $row[$keys[0]] . "'>" . $row[$keys[1]]. "</a>";
    echo "<br><br>";
}
?>

</body>

</html>
