<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json; charset=UTF-8");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
$statement = $db->prepare('SELECT * FROM Person limit 20 offset (:page-1)*20');
        if($statement) {
            $statement->bindValue(':page', $_GET['page']);
            $result = $statement->execute();
            if($result == true) {
                $arrayResult = [];
                while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
                    $arrayResult[] = $res;
                }
                echo json_encode($arrayResult, JSON_UNESCAPED_UNICODE);
            } else json_encode($err, JSON_UNESCAPED_UNICODE);
        }