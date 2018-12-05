<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>

<div class="container">
<h1>Last news</h1>

    <div id="news">

        <?php
            $sql = 'SELECT title, content, date FROM news';
            foreach  ($app->db()->con()->query($sql) as $news) {
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
