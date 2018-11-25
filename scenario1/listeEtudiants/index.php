<?php require("connexion_database.php"); ?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
</head>

<body>

<?php
if(isset($_SESSION['id_user'])) {
  $user = $_SESSION['id_user'];
  if(! isset($_GET['code'])){
      $code = $conn->query('SELECT c.code FROM classes c WHERE id_users = '. $user)->fetch();
        header('Location:index.php?code='.$code);
  }
}
else
    die("Login to access the user interface.");

$name = $conn->query('SELECT c.name FROM classes c WHERE id_users = '. $user)->fetch();
$code = isset($_GET['code']);
$order = isset($_POST['DESC']) ? 'DESC' : 'ASC';
?>

<h1>Classes Name : <?php echo $name;?></h1>
<h2>Classes Code : <?php echo $code;?></h2>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Grade</th>
    </tr>
    </thead>
    <tbody>
    <?php

    // Injection SQL
    // SELECT s.firstname, s.lastname, g.grade FROM students s JOIN grades g ON s.id_students = g.id_students JOIN classes c ON g.id_classes = c.id_classes
    // WHERE c.code = 'ENG-30'
    // or '1'='1' union select 1,2,3 FROM students s JOIN grades g ON s.id_students = g.id_students JOIN classes c ON g.id_classes = c.id_classes
    // WHERE c.name='Cyber-RSR'

    $students ='SELECT s.firstname, s.lastname, g.grade 
                FROM students s 
                JOIN grades g ON s.id_students = g.id_students 
                JOIN classes c ON g.id_classes = c.id_classes 
                WHERE c.code = '. $code .'
                ORDER BY s.firstname '. $order;

    foreach ($conn->query($students) as $student) {
        ?>
        <tr>
            <th class="counterCell"></th>
            <td><?php echo $student["firstname"]; ?></td>
            <td><?php echo $student["lastname"]; ?></td>
            <td><?php echo $student["grade"]; ?></td>
        </tr>

    <?php }; ?>
    </tbody>
</table>

<form action="index.php" method="post">
    <input type="submit" value="ASC">
    <input type="submit" name="DESC" value="DESC">
</form>


</body>

</html>
