<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>XSS - Display Cookie</title>

</head>

<body>


    <?php
        if (isset($_GET["name"])) {
            $user = $_GET["name"];
            setcookie("user", $user);
            setcookie("password", "neversaynotoacookie");
            echo("Hello " . $user . "!");
        }

        else {
            echo("Hello. What's your name?");
    ?>
            <form name="form-name" action="xss-display-cookie.php" method="get">
                <input type="text" name="name" value="" />
                <input type="submit" value="Submit"><br>
            </form>

        <?php
            }
        ?>
</body>
</html>
