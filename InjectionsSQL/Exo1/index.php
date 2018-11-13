<?php

$conn = new mysqli("localhost", "exo1", "mdpexo1");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<html>

<head></head>

<body>

<h1>Injection SQL : Exo1</h1>

<?php

$username = "";
$password = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function display_entry($username, $password, $true_username, $true_password) {
	if($username == $true_username && $password == $true_password && $username == "admin") {
		echo "<h3><font color='green'>Bien joué!</font><h3>";
	}
	echo "<h2>Welcome back " . $true_username . "!</h2><p>";
	echo "<input type='text' value='" . $true_username . "' disabled=''><br>";
	echo "<input type='password' value='" . $true_password . "' disabled=''></p><br>";
}

function try_connect($username, $password) {
	$dbname = "injectionSQL1";
	$conn = new mysqli("localhost", "exo1", "mdpexo1", $dbname);

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT username, password FROM users WHERE username='" . $username ."' AND password='" . $password . "';";
	$result = $conn->query($sql);

	//echo $sql . "<br>";

	if(!$result) {
<<<<<<< HEAD
		echo "<h3><font color='green'>Error : no such user/password</font></h3><br>";
=======
		//echo $conn->error;
>>>>>>> 9777371b783b91cb2a0e1cfdcd0cffcdcfe1c15f
		$conn->close();
	}
	else {
		$row = $result->fetch_assoc();
		$keys = array_keys($row);
		$n = count($keys);
		if($n != 0) {
			display_entry($username, $password, $row[$keys[0]], $row[$keys[1]]);
		}
		else {
			echo "<h3><font color='red'>Error : no such user/password</font></h3><br>";
		}
		$conn->close();		
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		$username = $_POST["username"];
		// On enlève les tentatives d'injection par le champ mdp
  		$password = test_input($_POST["password"]); 
  		try_connect($username, $password);
	}
}
?>

<form action="" method="post">
	Login
	<br>
	<input type="text" name="username">
	<br><br>
	Password
	<br>
	<input type="password" name="password">
	<br><br><br><br>
	<input type="submit" value="connect">
	<br><br>
</form>

</body>

</html>