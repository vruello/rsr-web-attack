<?php

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (isset($_SESSION['login']) || isset($_SESSION['password'])) {
        header('Location: cyberoom.php');
        exit;
    }

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        include('db-connect.php');
        $db = db_connect("config-admin.ini");

        $input_login = $_POST['login'];
        $input_password = $_POST['password'];

        // Prepare query
        $stmt = $db->prepare("SELECT login, password FROM users WHERE login = :login");

        // Bind values
        $stmt->bindValue(':login', $input_login);
        $stmt->execute();

        // Fetch row.
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        // Could not find a user with that username
        if ($res === false) {
            $error = "Invalid fields.";
        }

        else {
            $password =  $res['password'];
            // Correct password
            if (password_verify($input_password, $password)) {
              	session_start ();
          		$_SESSION['login'] = $input_login;
          		$_SESSION['password'] = $password;
                header('Location: cyberoom.php');
                exit;
            }

            else {
                $error = "Invalid fields.";
            }
        }
    }

    else {
        $error = "Empty field(s).";
    }
}
