<?php

function db_connect($config) {
    $db = parse_ini_file($config);

    $user = $db['user'];
    $pass = $db['pass'];
    $name = $db['name'];
    $host = $db['host'];
    $type = $db['type'];

    try {
        $dbh = new PDO($type . ':host=' . $host . ';dbname=' . $name, $user, $pass);

        return $dbh;
    }

    catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>
