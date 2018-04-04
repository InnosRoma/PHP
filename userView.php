<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json; charset=UTF-8");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
    $statement = $db->prepare('SELECT * FROM Person WHERE id = :id');
    $statement->bindValue(':id', $_GET['id']);
    $result = $statement->execute();
    while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    if (isset($res['id'])) {
        echo json_encode($err, JSON_UNESCAPED_UNICODE);
    }
    if(isset($_GET['phone'])){
        $value = $_GET['phone'];
        $statement = $db->prepare("SELECT * FROM Person WHERE phone LIKE '%" . $value . "%'");
        $results = $statement -> execute();
        while ($res = $results->fetchArray(SQLITE3_ASSOC)) {
            if (isset($res['id'])) {
                $row['phone'] = $res['phone'];
                $arrayResult[] = $res;
            } else {
                echo json_encode($err, JSON_UNESCAPED_UNICODE);
            }
        }
        echo json_encode($arrayResult, JSON_UNESCAPED_UNICODE);
    }