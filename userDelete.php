<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json; charset=UTF-8");
$q = $_GET['q'];
$row = array();
$err = array('status' => 'err', 'message' => 'Error!');
$sql1 = 'DELETE FROM Person WHERE id = ' . $_GET['id'];
$sql2 = 'DELETE FROM Person_Interests WHERE personId = ' . $_GET['id'];
$db->query($sql1);
$db->query($sql2);