<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>


<div class="container">
    
    
<h1>Last news</h1>

<?php if ($app->auth()->user() && $app->auth()->user()['username'] == 'veal'): ?>
    <div class="alert alert-success">
    Félicitations, vous êtes connecté en tant que veal. Le flag 1 est <strong><?= $app->flag(1) ?></strong>
    </div>
<?php endif; ?>

<?php if ($app->auth()->user() && $app->auth()->user()['username'] == 'lobster'): ?>
    <div class="alert alert-success">
    Félicitations, vous êtes connecté en tant que lobster. Le flag 3 est <strong><?= $app->flag(3) ?></strong>
    </div>
<?php endif; ?>

<?php if ($app->auth()->user() && $app->auth()->user()['username'] == 'salmon'): ?>
    <div class="alert alert-success">
    Félicitations, vous êtes connecté en tant que salmon. Le flag 4 est <strong><?= $app->flag(4) ?></strong>
    </div>
<?php endif; ?>

    
    <div id="news">

        <?php
            $sql = 'SELECT title, content, date FROM news';
            foreach  ($app->db()->con('readonly')->query($sql) as $news) {
				?>
				<div class="card mb-5">
				<div class="card-header">
					<?php echo $news['title']; ?>, <?php echo $news['date'] ?>
				</div>
				<div class="card-body">
				<?php echo $news['content']; ?>
				</div>
				</div>

            

            <?php } ?>
    </div>

</div>
<?php include('layout/footer.php'); ?>
