<?php
// // session_set_cookie_params(NULL, NULL, NULL, NULL, NULL, true, true);
// ini_set('session.cookie_httponly', 1);
//
// // **PREVENTING SESSION FIXATION**
// // Session ID cannot be passed through URLs
// ini_set('session.use_only_cookies', 1);
//
// // Uses a secure connection (HTTPS) if possible
// ini_set('session.cookie_secure', 1);
    session_start();

    // Check if the user is logged in.
    if(!isset($_SESSION['login']) || !isset($_SESSION['password'])){
        header('Location: index.php');
        exit;
    }

    include('data.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // User validated a clue
        if (isset($_POST['validate-clue'])) {
            $input = $_POST['validate-clue'];
            $clue = get_clue($db_admin, $stage);

            if ($input == $clue) {
                validate_stage($db_admin, $db_guest, $_SESSION['login'], $stage);
                // Update stage
                $stage = get_stage($db_admin, $_SESSION['login']);
                $description = get_description($db_admin, $stage);
                $validation_msg = "Congratulations!";
                $err_validation_msg = "";
            }

            else {
                $validation_msg = "";
                $err_validation_msg = "Sorry, the clue is not valid.";
            }
        }

        else if (isset($_POST['validate-password'])) {
            $key = '$2y$10$irNFvNIBAAobukUQuSv9ouYGTgb.Aqkjd1iPHhKtuNo2B7tIvwBnK';
            $input_key = $_POST['validate-password'];

            // OK!!!
            if (password_verify($input_key, $key)) {
                $freedom = true;
            }

            else {
                $msg_wrong_pwd = "Sorry, the password is not valid.";
            }
        }

        // User wrote a message
        else if (isset($_POST['write-message'])) {
            $msg = $_POST['write-message'];
            if (!empty($msg)) {
                // Remove document.cookie to prevent XSS
                if ($stage >= 3) {
                    $msg = str_replace('document.cookie', '', $msg);
                }

                // Private message
                if (isset($_POST['is-private'])) {
                    write_private_message($db_admin, $_SESSION['login'], $msg);
                }

                // Public message
                else {
                    write_message($db_guest, $_SESSION['login'], $msg);
                }
            }
        }

        else if (isset($_POST['searchbar'])) {
            $keyword = $_POST['searchbar'];
            $messages_found = search_message($db_guest, $keyword, $stage);
        }
    }

    else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Display only private messages in the messages board
        if (isset($_GET['private']) && $stage >= 4) {
            if ($_GET['private'] == 'true') {
                $private = true;
            }
        }

        // Make private messages public
        else if (isset($_GET['make-public']) && $stage >= 4) {
            make_public($db_admin, $db_guest, $_SESSION['login']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<?php include('head.php') ?>

<body id="page-top" class="bg-light">
    <header class="title">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">
              <?php
              if (!$freedom) {
                  echo "Escape the cyberoom!";
              } else {
                  echo "Freedom is yours.";
              }?></h1>
        </div>
      </div>
    </header>

<?php

if (!$freedom) {
    include('main-board.php');
    include('clues-board.php');

    if ($stage >= 2) {
        include('messages-board.php');
    }

    include('password-validation.php');
    include('js-scripts.php');
}

?>

</body>

</html>
