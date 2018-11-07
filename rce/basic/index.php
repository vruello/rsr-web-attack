<html>
<head>
<title>Dig Service</title>
</head>
<body>
<form method="POST" action="index.php">
        <input type="text" name="url" placeholder="google.fr">
        <input type="submit">
</form>
<?php 
	$FLAG = "diiiiiiiiiiiig___!";
	if(isset($_POST["url"]) && !empty($_POST["url"])){
        $response = shell_exec("timeout 5 bash -c 'dig +noall +answer " . $_POST["url"] . "'");
        #$response = shell_exec("dig +noall +answer " . $url);
        echo $response;
	}
?>
</body>
</html>