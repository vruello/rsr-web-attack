<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!empty($_POST['create-login']) && !empty($_POST['create-password']) && !empty($_POST['confirm-password'])) {
            $password = $_POST['create-password'];
            $confirm_password = $_POST['confirm-password'];
            //
            // echo 'pwd ' . $password;
            // echo 'cpwd ' . $password;
            //
            // if ($password != $confirm_password) {
            //     echo "Password do not match";
            // }
        }

        else {
            $message = "Missing field(s)";
        }
    }
?>

<script>
    // $("#create-account-form").submit(function(event) {
    //     console.log('submit');
    //     // Cancel form submission
    //     event.preventDefault();
    //
    //
    //     // Serialize the form data
    //     var formData = $(this).serialize();
    //
    //     // Submit the form using AJAX
    //     $.ajax({
    //         type: 'POST',
    //         url: test.php,
    //         data: formData,
    //         success: function(data) {
    //             alert(data)
    //         }
    //     });
    // });
</script>

<!-- Modal -->
<div class="modal fade" id="account-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Create account</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="create-account-form">
              <input type="text" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" name="create-login" placeholder="Login"><br/>

              <input type="password" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="create-password" name="create-password" placeholder="Password"><br/>

              <input type="password" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="confirm-password" name="confirm-password" placeholder="Confirm password"><br/>

              <small><span id="create-account-msg"><?php echo $message ?></span></small>

                <div class="align-right">
                    <!-- <button type="submit" class="btn btn-primary" data-dismiss="modal">Create account</button> -->
                    <button type="submit" class="btn btn-primary">Create account</button>
                </div>

            </form>
      </div>
      <div class="modal-footer"></div>

    </div>

  </div>
</div>

<script>
    $(function() { // called when DOM ready
            $('#create-password, #confirm-password').keyup(function () {
                equal_confirm_password();
        });

        function equal_confirm_password() {
            if ($('#create-password').val() == $('#confirm-password').val()) {
                $('#create-account-msg').html('');
            }
            else {
              $('#create-account-msg').html('Password do not match').css('color', 'red');
            }
        }
    });
</script>
