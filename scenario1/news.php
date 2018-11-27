<?php
    // To replace
    try {
        $conn = new PDO('mysql:host=localhost;dbname=Scenario1', 'root', 'root');
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage() . "<br/>";
        die();
    }
?>

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        addNews($conn, $_POST['form-news-title'], $_POST['form-news-content'], date("y-m-d"));
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>News</title>

    <!-- To refactor -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>

    <h1>News</h1>
    <div id="news">

        <?php
            $sql = 'SELECT title, content, date FROM news';

            foreach  ($conn->query($sql) as $news) {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $news['title']; ?>, <?php echo $news['date'] ?></h3>
                    </div>

                    <div class="panel-body">
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

</body>
