<!DOCTYPE html>
<html>

<head>
    <title>PHP loose comparison</title>
</head>

<body>

<form method="POST" action="login.php" class="form">
	<p>Hack the password : <input type="password" name="password" id="password"></p>
	<p><input type="submit" value="Give me the flag" ></p>
</form>

<div class="return-value"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $("document").ready(function(){
        $(".form").submit(function(){
        	$(".return-value").html("");
        	var data = {password: $('#password').val()};
        	var str = JSON.stringify({data});
        	
            $.ajax({
                type: "POST",
                url: "login.php",
                dataType: "json",
                data: {id : str},
                success: function(data) {
                   	$(".return-value").html(
                        data['status']
                    );
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                	//console.log(textStatus);
                }
            });
            return false;
        });
    });

</script>

</body>
</html>