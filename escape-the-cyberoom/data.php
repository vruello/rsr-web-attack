<?php

include('db-connect.php');
$db_admin = db_connect("config-admin.ini");
$db_guest = db_connect("config-guest.ini");

$stage = get_stage($db_admin, $_SESSION['login']);
$description = get_description($db_admin, $stage);

function get_stage($db, $login) {
    // Prepare query
    $stmt = $db->prepare("SELECT stage FROM users WHERE login =:login");

    // Bind values
    $stmt->bindValue(':login', $login);
    $stmt->execute();

    // Fetch row.
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['stage'];
}

function get_clues($db, $stage) {
    // Prepare query
    $stmt = $db->prepare("SELECT clue FROM stages WHERE id < :stage");

    // Bind values
    $stmt->bindValue(':stage', $stage);
    $stmt->execute();

    // Fetch row.
    $res = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    return $res;
}

function get_messages($db) {
    // Prepare query
    $stmt = $db->prepare("SELECT author, date, content FROM messages");
    $stmt->execute();

    // Fetch row.
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

function write_message($db, $login, $message) {
    // Prepare query
    $stmt = $db->prepare("INSERT INTO messages(author, date, content)  VALUES (:author, NOW(), :content)");

    // Bind values
    $stmt->bindValue(':author', $login);
    $stmt->bindValue(':content', $message);
    $stmt->execute();
}

function get_clue($db, $stage) {
    $stmt = $db->prepare("SELECT clue FROM stages WHERE id = :stage");
    $stmt->bindValue(':stage', $stage);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['clue'];
}

function get_description($db, $stage) {
    $stmt = $db->prepare("SELECT description FROM stages WHERE id = :stage");
    $stmt->bindValue(':stage', $stage);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['description'];
}

function validate_stage($db, $db_guest, $login, $stage) {
    $stmt = $db->prepare("UPDATE users SET stage = :stage WHERE login = :login");
    $stmt->bindValue(':stage', $stage + 1);
    $stmt->bindValue(':login', $login);
    $stmt->execute();

    if ($stage == 2) {
        clear_messages($db_guest);
        write_message($db_guest, 'admin', 'So many messages! A new searchbar feature was added for your convenience. Do your best!');
    }

    else if ($stage == 3) {
        clear_messages($db_guest);
        // Bob is not at stage 4
        $stmt = $db->prepare("UPDATE users SET stage = 4 WHERE login = 'bob'");
        $stmt->execute();
        write_message($db_guest, 'admin', 'The messages board has been cleared and updated. Now you can write secret messages!');
        write_message($db_guest, 'bob', 'Sorry @alice. I\'m already at stage 4 :)');
    }
}

function search_message($db, $keyword, $stage) {
    // Fix vulnerability
    if ($stage >= 4) {
        // Prepare query
        $stmt = $db->prepare("SELECT author, date, content FROM messages WHERE content LIKE CONCAT('%', CONCAT(:keyword, '%'))");
        $stmt->execute();

        // Fetch row.
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    else {
        // Vulnerable query
        $query = "SELECT author, date, content FROM messages WHERE content LIKE '%" . $keyword . "%'";
        $res = $db->query($query, PDO::FETCH_ASSOC);
        return $res;
    }
}

function get_private_messages($db, $login) {
    // Prepare query
    $stmt = $db->prepare("SELECT M.id, login, date, content FROM private_messages M INNER JOIN users U on M.author_id = U.id WHERE login=:login");
    $stmt->bindValue(':login', $login);
    $stmt->execute();

    // Fetch row.
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

function get_author_id($db, $login) {
    $stmt = $db->prepare("SELECT id FROM users WHERE login = :login");
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['id'];
}

function write_private_message($db, $login, $message) {
    $stmt = $db->prepare("INSERT INTO private_messages(author_id, date, content) VALUES (:id, NOW(), :content)");
    $id = get_author_id($db, $login);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':content', $message);
    $stmt->execute();
}

function make_public($db_admin, $db_guest, $login) {
    $private_messages = get_private_messages($db_admin, $login);

    foreach ($private_messages as $msg) {
        write_message($db_guest, $login, $msg['content']);
        delete_private_message($db_admin, $msg['id']);
    }
}

function delete_private_message($db, $message_id) {
    $stmt = $db->prepare("DELETE FROM private_messages WHERE id=:id");
    $stmt->bindValue(':id', $message_id);
    $stmt->execute();
}

function clear_messages($db) {
    $stmt = $db->prepare("DELETE FROM messages");
    $stmt->execute();
}

function get_secret($db, $login) {
    $stmt = $db->prepare("SELECT secret FROM users WHERE login = :login");
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['secret'];
}

function get_flag($db, $stage) {
    $stmt = $db->prepare("SELECT flag FROM stages WHERE id = :stage");
    $stmt->bindValue(':stage', $stage);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['flag'];
}

?>
