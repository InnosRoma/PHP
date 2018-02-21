<?php
$db = new SQLite3('user-store.db');
header('Content-Type: application/json; charset=utf-8');
$search_value = $_POST['interest/search'];
$row = array();
$err = array('status' => 'err', 'message' => 'Error!');
$i = 0;
$sql = "SELECT * FROM Interest WHERE description LIKE '%$search_value$%'";
$results = $db->query($sql);
while($res = $results->fetchArray()){
    if(isset($res['id'])) {
        $row[$i]['description'] = $res['description'];
        $i++;
         echo json_encode($row, JSON_UNESCAPED_UNICODE);

    } else {
        echo json_encode($err, JSON_UNESCAPED_UNICODE);
    }
}