<?php

if ($id != 0) {
  echo "<p>Vous ne pouvez pas accéder à cette page si vous êtes déjà connecté !</p>";
   exit(include("footer.php"));
}

$usernameErr = $passwordErr = $checkErr = "";
$username = $password = $cookie = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $cookie = $_POST["cookie"];

    if (empty($_POST["username"])) {
        $usernameErr = "Nom d'utilisateur requis !";
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Mot de passe requis !";
    } else {
        $password = test_input($_POST["password"]);
    }

    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        if (!check_user($username, $password, $cookie)) {
            $checkErr = "Nom d'utilisateur ou mot de passe invalide !";
        }
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function check_user($username, $password, $cookie) {
  $conn = connect();
  $sql = $conn->prepare("SELECT id_user, password, rank FROM users WHERE username = ? and password = ?");
  $sql->bind_param("ss", $username, sha1($password));
  $sql->execute();
  $result = $sql->get_result();
  $row = $result->fetch_assoc();
  $conn->close();

  if (empty($row)) {
    return false;
  } else {
    $expire = time() + 365*24*3600;
    setcookie('cookie', $cookie, $expire);
    header("Location: index.php");
  }
}

?>