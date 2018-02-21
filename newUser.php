<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
if ($q == 'user/new') {

    $statement = $db->prepare('INSERT INTO Person(firstName, lastName, phone, active, age) VALUES(:firstName, :lastName, :phone, :active, :age)');
    if ($statement) {
        $statement->bindValue(':firstName', $_GET['firstName']);
        $statement->bindValue(':lastName', $_GET['lastName']);
        $statement->bindValue(':phone', $_GET['phone']);
        $statement->bindValue(':active', $_GET['active']);
        $statement->bindValue(':age', $_GET['age']);
        $result = $statement->execute();
        if($result===true){
            $personArray = ['firstName' => $_GET['firstName'], 'lastName' => $_GET['lastName'], 'phone' => $_GET['phone'],
                'active' => $_GET['active'], 'age' => $_GET['age']];
            echo json_encode($personArray, JSON_UNESCAPED_UNICODE);
        }
    }
    $err = array('status' => 'err', 'message' => 'Error!');
}
else {
    $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    echo $errJSON;
}