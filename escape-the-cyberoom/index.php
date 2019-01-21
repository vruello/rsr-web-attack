<?php
    include('login.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <?php include('head.php') ?>
  <body id="page-top">

    <!-- Navigation -->
    <?php include('nav.php')?>

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">Escape the cyberoom!</h1>

          <form method="post" action="" id="login-form">
                <?php
                  // Check if the user is already logged in
                if (isset($_SESSION['login']) || isset($_SESSION['password'])) {
                ?>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">
                        <span class="transparent-input white align-center"><?php echo $_SESSION['login']?></input>
                    </h2>
                <?php }

              else { ?>

              <h2 class="text-white-50 mx-auto mt-2 mb-5">
                 <input type="text" class="transparent-input white align-center" name="login" placeholder="Login"></input>
              </h2>
              <h2 class="text-white-50 mx-auto mt-2 mb-5">
                  <input type="password" class="transparent-input white align-center" name="password" placeholder="Password"></input>
              </h2>
                <?php }?>
              <p id="error-msg" class="white"><i><?php echo $error; ?></i></p>

              <button type="submit" class="btn btn-primary js-scroll-trigger">Get Started</a></button>
            </form>
        </div>
      </div>
    </header>

    <?php include('js-scripts.php') ?>
    <?php include('create-account.php') ?>
    <?php include('footer.php') ?>

  </body>

</html>
