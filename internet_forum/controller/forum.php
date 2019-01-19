<?php

$topicErr = "";
$title = $message = $id_author = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["title"]) || empty($_POST["message"])) {
      $topicErr = "Veuillez remplir tous les champs !";
  } else if ($id == 0) {
      $topicErr = "Veuillez vous inscrire pour pouvoir créer un topic !";
  } else {
    $conn = connect();
    $title = htmlspecialchars($_POST["title"]);
    $title = $conn->real_escape_string($title);
    $message = htmlspecialchars($_POST["message"]);
    $message = $conn->real_escape_string($message);
    $conn->close();
    $topicErr = add_topic($title, $message, $id);
  }
}

function add_topic($title, $message, $id) {

  $conn = connect();
  $sql = $conn->prepare("SELECT id_topic FROM topics WHERE title = ?");
  $sql->bind_param("s", $title);
  $sql->execute();
  $result = $sql->get_result();
  $row = $result->fetch_assoc();
  $conn->close();

  if (!empty($row)) {
    return "Un topic similaire existe déjà !";
  }

  $conn = connect();
  $sql = $conn->prepare("INSERT INTO topics (title, id_topic_author, date_creation) VALUES (? , ?, NOW())");
  $sql->bind_param("si", $title, $id);
  $sql->execute();

  if (!$sql) {
    return "Erreur lors de la création du topic...";
  } else {
    $id_topic_sql = "SELECT id_topic FROM topics ORDER BY id_topic DESC LIMIT 0,1;";
    $result = $conn->query($id_topic_sql);
    $id_topic = $result->fetch_assoc()['id_topic'];

    $sql = $conn->prepare("INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (?, ?, NOW(), ?, false)");
    $sql->bind_param("iis", $id_topic, $id, $message);
    $sql->execute();

    if (!$sql) {
      return "Erreur lors de l'enregistrement du premier message...";
    }
  }

  $conn->close();
}

function list_topics() {
  $sql = "SELECT id_topic, title, username, date_creation FROM topics INNER JOIN users ON id_topic_author = id_user;";
  $conn = connect();
  $result = $conn->query($sql);
  $conn->close();

  while($row = $result->fetch_assoc()) {
    echo '
      <tr>
        <td>
            <small><span class="glyphicon glyphicon-screenshot" style="background-color: orange; color: #FFFFFF; padding: 5px; border-radius: 5px;"></span></small>
        </td>
        <td style="width: 100%;">
          <a href="topic.php?id_topic=' . $row['id_topic'] . '">' . $row['title'] . '</a>
          <br>
          <em class="visible-sm-inline visible-xs-inline">Créé par ' . $row['username'] . ' le ' . $row['date_creation'] . '</em>
        </td>
        <td style="white-space: nowrap;" class="hidden-sm hidden-xs">' . $row['username'] . '</td>
        <td style="white-space: nowrap;" class="hidden-sm hidden-xs">' . $row['date_creation'] . '</td>
      </tr>';
  }
}

?>
