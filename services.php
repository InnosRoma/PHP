<?php
$db = new SQLite3('user-store.db');

$results = $db->query('SELECT firstName FROM person');
while ($row = $results->fetchArray()) {
    var_dump($row);
}