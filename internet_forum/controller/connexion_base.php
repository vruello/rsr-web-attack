<?php 

session_start();

function connect() {
	$conn = new mysqli("localhost", "rsrwebsite", "teamwebrsr2018", "RSRWebsite");
	if ($conn->connect_error) {
		echo "Problème de connexion à la base de données...";
		exit(include("footer.php"));
	}
	return $conn;
}

function check_cookie($username, $password, $cookie) {
    $test_cookie = sha1($username . $password);
    if (strcmp($test_cookie, $cookie) === 0) {
    	return true;
    } else {
    	return false;
    }
}


if (isset ($_COOKIE['cookie']))
{
  $find = false;
  $sql = "SELECT * FROM users;";
  $conn = connect();
  $result = $conn->query($sql);
  $conn->close();
  while($row = $result->fetch_assoc()) {
  	if (check_cookie($row['username'], $row['password'], $_COOKIE['cookie'])) { 
		$lvl = $row['rank'];
		$id = $row['id_user'];
		$pseudo = $row['username'];
		$find = true;
  		break;
  	}
  }

  if (!$find) {
  	$lvl = 0;
  	$id = 0;
  	$pseudo = '';
  } 
  
} else {
   $lvl = 0;
  $id = 0;
  $pseudo = '';
}

?>
