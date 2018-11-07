<form action = "" method = "POST">
    Password <br/>
    <input type="password" name="password" />
    <input type="submit" value="Let me in" />
</form>

<?php
include("pass.php");
session_start();
if (!isset($_SESSION["logged"])){
    $_SESSION["logged"] = 0;
}

// importe les variables issues du $_POST dans la table des symboles
extract($_POST, 0);

if((isset($_POST["password"]) && $_POST["password"] != "" && $_POST["password"] == $FLAG) || (is_array($_SESSION) && $_SESSION["logged"] == 1)){
    echo "Well done! FLAG: " . $FLAG;
} else {
    echo "Oppps... try again!";
}

?>