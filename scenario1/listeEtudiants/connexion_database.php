<?php

$host = "localhost";
$port = 3308;
$database = "scenario1";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>