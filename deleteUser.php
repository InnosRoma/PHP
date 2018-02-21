<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
$err = array('status' => 'err', 'message' => 'Error!');
if ($q == 'user/delete') {
    $sql1 = 'DELETE FROM Person WHERE id = ' . $_GET['id'];
    $sql2 = 'DELETE FROM Person_Interests WHERE personId = ' . $_GET['id'];
    $results1 = $db->query($sql1);
    $results2 = $db->query($sql2);
    echo json_encode("User was deleted.");
}
else {
    echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);;
}