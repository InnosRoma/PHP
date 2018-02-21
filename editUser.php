<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
if($q == 'user/edit') {
    $statement = $db->prepare('UPDATE Person SET
    firstName = :firstName, lastName = :lastName, phone = :phone, active = :active, age = :age WHERE id =' . $_GET['id']);
    $statement->bindValue(':firstName', $_GET['firstName']);
    $statement->bindValue(':lastName', $_GET['lastName']);
    $statement->bindValue(':phone', $_GET['phone']);
    $statement->bindValue(':active', $_GET['active']);
    $statement->bindValue(':age', $_GET['age']);
    $result = $statement->execute();
    if ($result === true) {
        $personArray = ['firstName' => $_GET['firstName'], 'lastName' => $_GET['lastName'], 'phone' => $_GET['phone'],
            'active' => $_GET['active'], 'age' => $_GET['age']];
        echo json_encode($personArray, JSON_UNESCAPED_UNICODE);
    }
    $err = array('status' => 'err', 'message' => 'Error!');
}
else {
    $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    echo $errJSON;
}