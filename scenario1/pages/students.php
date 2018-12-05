

<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>

<div class="container">

<?php 

$user = $app->auth()->user();
$code = $app->request()->get('code');

if ($code && (preg_match("/update/i", $code) 
        || preg_match("/insert/i", $code) 
        || preg_match("/delete/i", $code) 
        || preg_match("/handler/i", $code)
        || preg_match("/replace/i", $code))) {
    $code = null;
}


if ($code) { 

    $req = $app->db()->con()->prepare('SELECT * FROM classes WHERE code = :code');
    $req->execute(array(':code' => $code));
    
    $data = $req->fetchAll();
    $req->closeCursor();
    
    $name = null;

    if (count($data) === 1) {
        $name = $data[0]['name'];
    }

    
    $students ='SELECT s.firstname, s.lastname, g.grade 
                FROM students s 
                JOIN grades g ON s.id_students = g.id_students 
                JOIN classes c ON g.id_classes = c.id_classes 
                WHERE c.code = "'. $code .'" ';
    
    $students = $app->db()->con()->query($students);

    ?>

        <h1><?php echo $name;?></h1>

        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><?php echo $code;?></li>
        </ol>
        </nav>

        <table class="table">
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
                foreach ($students as $student):
                ?>
                    <tr>
                        <th class="counterCell"></th>
                        <td><?php echo $student["firstname"]; ?></td>
                        <td><?php echo $student["lastname"]; ?></td>
                        <td><?php echo $student["grade"]; ?></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    <?php
}
else {
    $req = $app->db()->con()->prepare('SELECT * FROM classes WHERE id_users = :id_users');
    $req->execute(array(':id_users' => $user['id_users']));

    $classes = $req->fetchAll();
    $req->closeCursor();

    ?>

    <h1>Your classes</h1>

    <div class="list-group">
        <?php foreach ($classes as $class):?>
            <a class="list-group-item list-group-item-action" href="<?= $app->router()->url('students', ['code' => $class['code']]) ?>"><?= $class['name'] ?></a>
        <?php endforeach; ?>
    </div>

    <?php
}
?>

    

<?php include('layout/footer.php'); ?>
