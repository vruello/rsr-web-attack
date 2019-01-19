<?php

$usernameErr = "";
$username =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["MAX_FILE_SIZE"])) {
    if (empty($_POST["username"])) {
        $usernameErr = "Nom d'utilisateur requis !";
    } else {
      $conn = connect();
      //injection SQL
      //$username = mysqli_real_escape_string($conn, $_POST["username"]);
      $username = $_POST["username"];
      $username = check_user($username, $conn);
      if (!$username) {
        $usernameErr = "L'utilisateur n'est pas enregistré !";
      } else {
        report_user($username, $conn);
      }
      $conn->close();
    }
  }
}

function check_user($username, $conn) {
  $sql = "SELECT username FROM users WHERE username = '" . $username . "';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if (empty($row)) {
    return false;
  } else {
    return $row['username'];
  } 
}

function report_user($username, $conn) {
  $sql = "UPDATE users SET reported = true WHERE username = '" . $username . "';";
  if (!$conn->query($sql)) {
    echo "<p style='color : red'>Erreur lors du signalement de l'utilisateur " . htmlspecialchars($username) ."...</p>";
  } else {
    echo "<p style='color : green'>L'utilisateur " . htmlspecialchars($username) ." a bien été signalé !</p>";
  }
}

?>
