<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
if ($q == 'user/view') {
    $sql = 'SELECT * FROM Person WHERE id = ' . $_GET['id'];
    $results = $db->query($sql);
    $row = array();

    while ($res = $results->fetchArray(SQLITE3_ASSOC)) {
            echo $personJSON = json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    if (isset($res['id'])) {
            echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
    }
}
else {
    echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
}