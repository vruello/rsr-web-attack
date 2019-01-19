<?php

if ($id != 0) {
    echo "<p>Vous ne pouvez pas accéder à cette page si vous êtes déjà connecté !</p>";
    exit(include("footer.php"));
}

$usernameErr = $passwordErr = $confirmpasswordErr = "";
$username = $password = $confirmpassword = "";
$valid_user = $valid_password = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $usernameErr = "Nom d'utilisateur requis !";
    } else {
        $username = test_input($_POST["username"]);
        if (test_username($username)) {
            $valid_user = true;
        } else {
            $usernameErr = "Nom d'utilisateur déjà utilisé !";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Mot de passe requis !";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (empty($_POST["confirmpassword"])) {
        $confirmpasswordErr = "Confirmation du mot de passe requis !";
    } else {
        $confirmpassword = test_input($_POST["confirmpassword"]);
    }

    if (!empty($_POST["password"]) && !empty($_POST["confirmpassword"])) {
        if ($password != $confirmpassword) {
            $confirmpasswordErr = "Confirmation du mot de passe invalide !";
        } else {
            if (test_password($password)) {
                $valid_password = true;
            } else {
                $passwordErr = "Mot de passe déjà utilisé !";
            }
        }
    }

    if ($valid_user && $valid_password) {
        add_user($username, $password);
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function test_username($username) {
  $conn = connect();
  $sql = $conn->prepare("SELECT id_user FROM users WHERE username = ?");
  $sql->bind_param("s", $username);
  $sql->execute();
  $result = $sql->get_result();
  $row = $result->fetch_assoc();
  $conn->close();

  if (empty($row)) {
    return true;
  } else {
    return false;
  } 
}

function test_password($password) {
  $conn = connect();
  $sql = $conn->prepare("SELECT id_user FROM users WHERE password = ?");
  $sql->bind_param("s", sha1($password));
  $sql->execute();
  $result = $sql->get_result();
  $row = $result->fetch_assoc();
  $conn->close();

  if (empty($row)) {
    return true;
  } else {
    return false;
  }
}

function add_user($username, $password) {
  $conn = connect();
  $sql = $conn->prepare("INSERT INTO users (username, password, rank, reported) VALUES (?, ?, 1, false)");
  $sql->bind_param("ss", $username, sha1($password));
  $sql->execute();
  $conn->close();

  if ($sql) {
    echo "<p style='color : green'>Inscription validée !</p>";
  } else {
    echo "<p style='color : red'>Erreur lors de l'inscription...</p>";
  }
}

?>