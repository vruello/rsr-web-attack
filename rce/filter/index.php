<html>
<head>
  	<title>Dig Service</title>
</head>

<body>
   	<form method="POST" action="">
   		<input type="text" name="url" placeholder="google.fr">
   		<input type="submit">
   	</form>

</body>
</html>

   <?php 

   $FLAG = "C0mAnDe_iNjecTion!";

   if(isset($_POST["url"]) && !empty($_POST["url"])){
   	$url = preg_replace("/[\\\$|`;<>]/", "", $_POST["url"]); 
   	$response = shell_exec("timeout 5 bash -c 'dig +noall +answer " . $url . "'"); 
      #$response = shell_exec("dig +noall +answer " . $url); 

      if (strlen($response) > 0) {
         echo "Dig OK";
      } else{
         echo "Syntax Error";
      }
   }

   ?>