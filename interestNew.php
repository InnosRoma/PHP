<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json; charset=UTF-8");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
$statement = $db->prepare('INSERT INTO Interest(description) VALUES(:description)');
        if ($statement) {
            $statement->bindValue(':description', $_GET['description']);
            $result = $statement->execute();
            if($result == true) {
                $interestArray = ['description' => $_GET['description']];
                echo json_encode($interestArray, JSON_UNESCAPED_UNICODE);
            }
        }
        else json_encode($err, JSON_UNESCAPED_UNICODE);