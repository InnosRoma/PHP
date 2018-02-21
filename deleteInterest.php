<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
if ($q == 'interest/delete') {
    $sql1 = 'DELETE FROM Interest WHERE id = ' . $_GET['id'];
    $sql2 = 'DELETE FROM Person_Interests WHERE interestId = ' . $_GET['id'];
    $results1 = $db->query($sql1);
    $results2 = $db->query($sql2);
    echo json_encode("Interest was deleted");
}
else {
    echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);;
}