<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
if ($q == 'user/list') {
    $sql = 'SELECT * FROM Person limit 20 offset ' . $_GET['page'];
    $results = $db->query($sql);
    $row = array();
    $err = array('status' => 'err', 'message' => 'Error!');

    while ($res = $results->fetchArray(SQLITE3_ASSOC)) {
        echo $personJSON = json_encode($res, JSON_UNESCAPED_UNICODE);
    }
    if (isset($res['id'])) {
        echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    }
}
else {
    echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);;
}