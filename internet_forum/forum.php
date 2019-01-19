<?php
$pagetitle="forum";
include "header.php";

include "controller/forum.php";
?>

<h2>Bienvenue sur le forum ! </h2>
<br>

<?php
if ($lvl == 1 || $lvl == 2 || $lvl == 3) {
  echo '
  <button class="btn btn-warning" data-toggle="collapse" data-target="#form_topic">Créer un nouveau topic</button>
  <br><span class="error">' . $topicErr . '</span>
  <form method="post" id="form_topic" class="collapse">
    <br>
    <div class="form-group">
      <label for="title">Titre du topic :</label>
      <input type="text" class="form-control" name="title" id="title">
    </div>
    <div class="form-group">
      <textarea name="message" class="form-control" rows="8" cols="80"></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Créer</button>
  </form>';
}
?>

<table class="table table-striped" style="margin-top: 10px;">
  <thead>
    <tr>
      <td></td>
      <td style="width: 100%;">Sujet</td>
      <td style="white-space: nowrap;" class="hidden-sm hidden-xs">Auteur</td>
      <td style="white-space: nowrap;" class="hidden-sm hidden-xs">Date de création</td>
    </tr>
  </thead>
  <tbody>

  <?php
    list_topics();
  ?>

  </tbody>
</table>

<?php include "footer.php" ?>