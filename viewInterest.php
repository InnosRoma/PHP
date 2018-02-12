<?php
$db = new SQLite3('user-store.db');
header('Content-Type: application/json; charset=utf-8');
$q = $_GET['q'];
if ($q == 'interest') {
    $sql = 'SELECT * FROM Interest WHERE id = ' . $_GET['id'];
    $results = $db->query($sql);
    $row = array();
    $err = array('status' => 'err', 'message' => 'Error!');
    $i = 0;
    while ($res = $results->fetchArray()) {

        if (isset($res['id'])) {

            $row[$i]['description'] = $res['description'];
            $i++;

            $interestJSON = json_encode($row, JSON_UNESCAPED_UNICODE);
            echo $interestJSON;

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