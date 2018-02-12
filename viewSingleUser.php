<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
if ($q == 'user') {
    $sql = 'SELECT * FR OM Person WHERE id = ' . $_GET['id'];
    $results = $db->query($sql);
    $row = array();
    $err = array('status' => 'err', 'message' => 'Error!');
    $i = 0;
    while ($res = $results->fetchArray()) {

        if (isset($res['id'])) {

            $row[$i]['firstName'] = $res['firstName'];
            $row[$i]['lastName'] = $res['lastName'];
            $row[$i]['phone'] = $res['phone'];
            $row[$i]['active'] = $res['active'];
            $row[$i]['age'] = $res['age'];
            $i++;

            $personJSON = json_encode($row, JSON_UNESCAPED_UNICODE);
            echo $personJSON;

        } else {
            $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
            echo $errJSON;
        }
    }
    if ($i == 0) {
            $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
            echo $errJSON;
    }
}
else {
    $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    echo $errJSON;
}
