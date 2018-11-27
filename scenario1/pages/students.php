
<?php
$user = $app->auth()->user();
$code = $app->request()->get('code');

if(!$code) {
	$req = $app->db()->con()->prepare('SELECT c.code FROM classes c WHERE id_users = :id_users');
	$req->execute(array(':id_users' => $user['id_users']));
	$code = $req->fetch()[0];
	$req->closeCursor();

	$app->router()->redirect('students', ['code' => $code]);
}

$req = $app->db()->con()->prepare('SELECT c.name FROM classes c WHERE id_users = :id_users');
$req->execute(array(':id_users' => $user['id_users']));

$name = $req->fetch()[0];
$req->closeCursor();

$order = $app->request()->get('order');
?>

<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>

<div class="container">

<h1>Classes Name : <?php echo $name;?></h1>
<h2>Classes Code : <?php echo $code;?></h2>

<table class="users">
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
				WHERE c.code = "'. $code .'" ';
	
	if ($order) {
		$students .= 'ORDER BY s.firstname '. $order;
	}
                

    foreach ($app->db()->con()->query($students) as $student) {
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

<a href="<?= $app->router()->url(null, ['code' => $code, 'order' => 'asc']) ?>">ASC</a>
<a href="<?= $app->router()->url(null, ['code' => $code, 'order' => 'desc']) ?>">DESC</a>

</div>

<?php include('layout/footer.php'); ?>
