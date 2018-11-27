<?php 

// Login form submitted?
if ($app->request()->post('username') && $app->request()->post('password')) {
	$res = $app->auth()->login($app->request()->post('username'), $app->request()->post('password'));

	// are credentials valid?
	if ($res === true) {
		$app->router()->redirect('home');
	}
	
}

?>


<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>


<div class="container">
<h1>Login</h1>

<?php if ($res === false): ?>
<div>
	Echec de la connexion
</div>
<?php endif; ?>

<form action="" method="POST" role="form">

	<div class="form-group">
		<label for="">Username</label>
		<input type="text" class="form-control" name="username">
	</div>

	<div class="form-group">
		<label for="">Password</label>
		<input type="password" class="form-control" name="password">
	</div>

	

	<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php include('layout/footer.php'); ?>
