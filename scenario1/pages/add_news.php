
<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>


<?php
    function addNews($conn, $title, $content, $date) {
        try {
            $stmt = $conn->prepare("INSERT INTO news (title, content, date) VALUES (:title, :content, :date)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
        }

        catch(PDOException $e) {
            echo "Sorry, an error occurred.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $app->request()->post('form-news-title') && $app->request()->post('form-news-content')) {
        addNews($app->db()->con(),$app->request()->post('form-news-title'), $app->request()->post('form-news-content'), date("y-m-d"));
    }
?>
<div class="container">
    <h1>News</h1>
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

    <?php
        //TODO test if user == communication manager to display form
    ?>

    <div id="news-form">
        <h2>Add news</h2>

        <form action="" method="post">
            <div class="form-group">
                <label for="form-news-title">Title</label>
                <textarea class="form-control" id="form-news-title" name="form-news-title" rows="1"></textarea>
            </div>

            <div class="form-group">
                <label for="form-news-content">Content</label>
                <textarea class="form-control" id="form-news-content" name="form-news-content" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>
<?php include('layout/footer.php'); ?>

