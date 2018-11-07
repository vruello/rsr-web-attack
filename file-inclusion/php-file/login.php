<?php 

require('config.php');

if (isset($_POST['secret'])) {
    if ($_POST['secret'] === $secret_password) {
        echo 'OK';
    }
    else {
        echo 'TRY AGAIN';
    }
}

?>
<form action="" method="POST">
    <label>Enter the secret password: </label>
    <input type="password" name="secret" />
    <input type="submit">
</form>

<?php
