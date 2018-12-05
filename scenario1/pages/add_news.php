
<?php include('layout/header.php'); ?>
<?php include('layout/nav.php'); ?>


<div class="container">

<?php
    function addNews($conn, $title, $content, $date) {
        try {
            $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
            $title = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $title);

            $stmt = $conn->prepare("INSERT INTO news (title, content, date) VALUES (:title, :content, :date)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->execute();
        }

        catch(Exception $e) {
            echo '<div class="alert alert-danger">Sorry, an error occurred.</div>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $app->request()->post('form-news-title') && $app->request()->post('form-news-content')) {
        addNews($app->db()->con(),$app->request()->post('form-news-title'), $app->request()->post('form-news-content'), date("y-m-d"));
    }
?>

    <div id="news-form">
        <h1>Add news</h1>

        <form action="" method="post">
            <div class="form-group">
                <label for="form-news-title">Title</label>
                <input type="text" class="form-control" id="form-news-title" name="form-news-title" />
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

