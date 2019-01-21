<div class="container">
    <!-- Password validation section -->
    <section id="password-validation" class="signup-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-center">

                    <i class="fas fa-unlock-alt fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Enter the password to get out.</h2>

                    <form class="form-inline d-flex" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                        <input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="validate-password" name="validate-password" placeholder="Enter password...">
                        <button type="submit" class="btn btn-primary mx-auto">Go</button>
                    </form>
                    <p class="white"><small><?php echo $msg_wrong_pwd;?></small></p>
                </div>
            </div>
        </div>
    </section>
</div>
