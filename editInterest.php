<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
if($q == 'interest/edit') {
    $statement = $db->prepare('UPDATE Interest SET
    description = :description WHERE id =' . $_GET['id']);
    $statement->bindValue(':description', $_GET['description']);
    $result = $statement->execute();
    if ($result === true) {
        $personArray = ['description' => $_GET['description']];
        echo json_encode($personArray, JSON_UNESCAPED_UNICODE);
    }
    $err = array('status' => 'err', 'message' => 'Error!');
}
else {
    $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    echo $errJSON;
}