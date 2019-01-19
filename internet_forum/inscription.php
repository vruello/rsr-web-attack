<?php
$pagetitle="inscription";
include "header.php";

include "controller/inscription.php";
?>

<h2>Inscription</h2>
<br>

<form method="post">
  <div class="form-group">
    <label for="Username">Nom d'utilisateur</label>
    <input type="text" name="username" class="form-control" id="Username" aria-describedby="emailHelp" placeholder="Nom d'utilisateur" style="width: 350px;">
    <span class="error"><?php echo $usernameErr;?></span>
  </div>

  <div class="form-group">
    <label for="Password">Mot de passe</label>
    <input type="password" name="password" class="form-control" id="Password" placeholder="Mot de passe" style="width: 350px;">
    <small class="form-text text-muted">Choisissez bien votre mot de passe !</small><br>
    <span class="error"><?php echo $passwordErr;?></span>
  </div>

  <div class="form-group">
    <label for="Password">Confirmer le mot de passe</label>
    <input type="password" name="confirmpassword" class="form-control" id="Password" placeholder="Confirmer le mot de passe" style="width: 350px;">
    <span class="error"><?php echo $confirmpasswordErr;?></span>
  </div>

  <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>                 

<?php include "footer.php" ?>
