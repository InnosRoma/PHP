<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json; charset=UTF-8");
$q = $_GET['q'];
$row = array();
$err = array('status' => 'err', 'message' => 'Error!');
switch ($q) {
    case "user/new":
        require "newUser.php";
        break;
    case "user/list":
        require "userList.php";
        break;
    case "user/view":
        require "userView.php";
        break;
    case "user/search":
        require "userSearch.php";
        break;
    case "user/edit":
        require "userEdit.php";
        break;
    case "user/delete":
        require "userDelete.php";
        break;
    case "interest/new":
        require "interestNew.php";
        break;
    case "interest/view":
        $statement = $db->prepare('SELECT * FROM Interest WHERE id = :id');
        $statement->bindValue(':id', $_GET['id']);
        $result = $statement->execute();
        while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        if (isset($res['id'])) {
            echo json_encode($err, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "interest/search":
        $value = $_GET['value'];
        $statement = $db->prepare("SELECT * FROM Interest WHERE description LIKE '%" . $value . "%'");
        $results = $statement -> execute();
        while ($res = $results->fetchArray()) {
            if (isset($res['id'])) {
                $row['description'] = $res['description'];
                echo json_encode($row, JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode($err, JSON_UNESCAPED_UNICODE);
            }
        }
        break;
    case "interest/edit":
        $statement = $db->prepare('UPDATE Interest SET description = :description WHERE id =' . $_GET['id']);
        $statement->bindValue(':description', $_GET['description']);
        $result = $statement->execute();
        if ($result == true) {
            $personArray = ['description' => $_GET['description']];
            echo json_encode($personArray, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "interest/delete":
        $sql1 = 'DELETE FROM Interest WHERE id = ' . $_GET['id'];
        $sql2 = 'DELETE FROM Person_Interests WHERE interestId = ' . $_GET['id'];
        $results1 = $db->query($sql1);
        $results2 = $db->query($sql2);
        echo json_encode("Interest was deleted");
        break;
    case "login":
        $connection = new SQLite3('user-store.db');
        $msg = '';            
            if (isset($_POST['email']) && !empty($_POST['password'])) {

               if ($_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'tutorialspoint';
                  
                  echo 'You have entered valid password';
               }else {
                  $msg = 'Wrong username or password';
               }
            }
        break;
}