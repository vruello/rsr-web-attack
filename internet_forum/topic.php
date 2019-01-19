<?php
$pagetitle="forum";
include "header.php";

include "controller/topic.php";

$id_topic = "";
if (isset($_GET['id_topic']))
{
  $id_topic = $_GET['id_topic'];
}

check_topic($id_topic);

?>

<a class="btn btn-warning" href="forum.php">Retour à la liste des sujets</a> 
<?php
if ($lvl == 1 || $lvl == 2 || $lvl == 3) {
  echo '<a href="#form_comment" class="btn btn-warning">Répondre</a>';
}
?>
  
<br>
<?php
  list_posts($id_topic, $lvl);
?>

<?php
if ($lvl == 1 || $lvl == 2 || $lvl == 3) {
  echo '
    <form id="form_comment" method="post">
      <h3>Ajouter un commentaire</h3>
      <div>
      <span class="error">' . $postErr . '</span>
      <input type="hidden" name="id_topic" value="' . $id_topic .'">
      <div class="form-group">
        <textarea class="form-control" name="message" rows="8" cols="80"></textarea>
      </div>
      <button type="submit" class="btn btn-warning">Publier</button>
      </div>
    </form>';
}
?>


<?php include "footer.php" ?>