<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
if ($q == 'interest/new') {

    $statement = $db->prepare('INSERT INTO Interest(description) VALUES(:description)');
    if ($statement) {
        $statement->bindValue(':description', $_GET['description']);
        $result = $statement->execute();
    }
    echo $newInterestJSON = json_encode($statement, JSON_UNESCAPED_UNICODE);

    $row = array();
    $err = array('status' => 'err', 'message' => 'Error!');
}
else {
    $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    echo $errJSON;
}