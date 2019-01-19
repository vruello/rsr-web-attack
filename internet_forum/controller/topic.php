<?php

$postErr = "";
$message = $id_topic = $id_post = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (!empty($_POST["id_post"])) {
    $id_post = $_POST["id_post"];
    report_post($id_post);
  } else {
      if (empty($_POST["message"])) {
      $postErr = "Veuillez ajouter un commentaire !";
    } else if ($id == 0) {
        $topicErr = "Veuillez vous inscrire pour pouvoir ajouter un commentaire !";
    } else {
      //$message = htmlspecialchars($_POST["message"]);
      $message = $_POST["message"];
      $id_topic = $_POST["id_topic"];
      //$id_topic = htmlspecialchars($id_topic);
      //$id_topic = $conn->real_escape_string($id_topic);
      $postErr = add_post($message, $id_topic, $id);
    }
  }
}

function report_post($id_post) {
  $conn = connect();
  $sql = $conn->prepare("UPDATE posts SET reported = true WHERE id_post = ?");
  $sql->bind_param("i", $id_post);
  $sql->execute();
  $conn->close();

  if ($sql) {
    echo "<p style='color : green'>Le commentaire a bien été signalé !</p>";
  } else {
    echo "<p style='color : red'>Erreur lors du signalement du commentaire...</p>";
  }
}

function add_post($message, $id_topic, $id_user) {
  $sql = "INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (" . $id_topic . ", " . $id_user . ", '" . date('Y-m-d H:i:s') ."', '" . $message . "', false);";
  $conn = connect();
  if (!$conn->query($sql)) {
    return "Erreur lors de l'enregistrement du commentaire...";
  }
  $conn->close();
}

function msg_err() {
  echo '
  <div class="jumbotron">
  <h2>Topic non trouvé</h2>
  <div class="row">
    <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
      <img src="images/notfound.jpg" alt="" class="img-responsive">
    </div>
  </div>
  <p>Le topic auquel vous voulez accéder n\'est pas accessible.</p>
  </div>';

  exit(include("footer.php"));
}

function check_topic($id_topic) {
  if (empty($id_topic)) {
    msg_err();
  }

  if (!ctype_digit($id_topic)) {
    msg_err();
  }

  $id_topic_sql = "SELECT id_topic FROM topics ORDER BY id_topic DESC LIMIT 0,1;";
  $conn = connect();
  $result = $conn->query($id_topic_sql);
  $res_id_topic = $result->fetch_assoc()['id_topic'];
  $conn->close();
  
  if ($id_topic > $res_id_topic || $id_topic < 1) {
    msg_err();
  }
}

function list_posts($id_topic, $lvl) {
  $sql = "SELECT id_post, post, date_post, username, posts.reported FROM posts INNER JOIN users ON id_post_author = id_user WHERE id_post_topic = " . $id_topic ." ORDER BY id_post ASC;";
  $conn = connect();
  $result = $conn->query($sql);
  $conn->close();

  while ($row = $result->fetch_assoc()) {
    echo '
        <div class="media"><p>' . $row['post'] . '</p></div>
        <form id="report" method="post">
          <input type="hidden" name="id_post" value="' . $row['id_post'] .'">

          <button type="submit" class="btn btn-warning" style="padding: 0px; border-radius: 5px; background-color: rgba(0, 0, 0, 0); border-width: 0px;" onclick="return confirm(`Signaler le commentaire ?`)"; >
            <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style="background-color:orange; padding: 5px; border-radius: 5px;">
            </span>
          </button>';

    if (($lvl == 2 || $lvl == 3) && $row['reported'] == true) {
      echo '
          <button type="button" class="btn btn-warning" style="padding: 0px; border-radius: 5px; background-color: rgba(0, 0, 0, 0); border-width: 0px;">
            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="background-color:red; padding: 5px; border-radius: 5px;">
            </span>
          </button>';
    }


    echo '
          <small style="padding-left: 30px;">'. $row['username'] .' le ' . $row['date_post'] . '</em></small></p>
        </form>';
  }
}

?>
