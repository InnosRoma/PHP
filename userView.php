<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json; charset=UTF-8");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
    $UserStatement = $db->prepare('SELECT * FROM Person WHERE id = :id');
    $UserStatement->bindValue(':id', $_GET['id']);
    $InterestStatement = $db->prepare('SELECT PerInter.interestId, Inter.description FROM Person_Interests AS PerInter LEFT JOIN Interest AS Inter ON PerInter.interestId = Inter.id WHERE PerInter.personId = :id');
    $InterestStatement->bindValue(':id', $_GET['id']);
    $result1 = $UserStatement->execute();
    $result2 = $InterestStatement->execute();
    $arrayResult = [];
    if($result1 == true && $result2 == true) {
    while ($res = $result1->fetchArray(SQLITE3_ASSOC)) {
        $user_info = $res;
    }
    $user_info['interests'] = [];
    while ($res = $result2->fetchArray(SQLITE3_ASSOC)) {
        $user_info['interests'][] = $res;
    }
    $arrayResult = $user_info;
    echo json_encode($arrayResult, JSON_UNESCAPED_UNICODE);
} else echo json_encode($err, JSON_UNESCAPED_UNICODE);