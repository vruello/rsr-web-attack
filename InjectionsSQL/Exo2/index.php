<?php

$dbname = "injectionSQL2";
$conn = new mysqli("localhost", "exo2", "mdpexo2", $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html>

<head></head>

<body>

<h1>Injection SQL : Exo2</h1>

<?php

if(!empty($_GET['category']))
{
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    $sql = "SELECT title, DATE_FORMAT(date, '%d/%m/%Y') AS date FROM projets WHERE category_id = ".$category;
    $result = $conn->query($sql);
    
    echo "<u>";

    if(mysqli_num_rows($result) > 0)
    {
        while($r = mysqli_fetch_assoc($result))
        {
            echo "<li><a href=\"#\">".htmlspecialchars($r['title'])." - ".$r['date']."</a></li>";
        }
    }

    echo "</u>";
}

?>


<h3>Types de projets</h3>

<?php

$sql = "SELECT id, title FROM categories;";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
	$keys = array_keys($row);	
	echo "<a href='?category=" . $row[$keys[0]] . "'>" . $row[$keys[1]]. "</a>";
	echo "<br><br>";
}
?>

</body>

</html>
