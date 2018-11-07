<?php
// Create connection
$conn = new mysqli($servername, "exo1", "exo1");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<html>

<head></head>

<body>

<h1>Injection SQL : Exo1</h1>

<form action="" method="post">
	Login
	<br>
	<input type="text" name="login">
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