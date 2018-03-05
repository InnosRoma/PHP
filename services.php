<?php
$db = new SQLite3('user-store.db');
header("Content-type:application/json");
$q = $_GET['q'];
$row = array();
$err = array('status' => 'err', 'message' => 'Error!');
switch ($q) {
    case "user/new":
        $statement = $db->prepare('INSERT INTO Person(firstName, lastName, phone, active, age) VALUES(:firstName, :lastName, :phone, :active, :age)');
        if ($statement) {
            $statement->bindValue(':firstName', $_GET['firstName']);
            $statement->bindValue(':lastName', $_GET['lastName']);
            $statement->bindValue(':phone', $_GET['phone']);
            $statement->bindValue(':active', $_GET['active']);
            $statement->bindValue(':age', $_GET['age']);
            $result = $statement->execute();
            if ($result === true) {
                $personArray = ['firstName' => $_GET['firstName'], 'lastName' => $_GET['lastName'], 'phone' => $_GET['phone'],
                    'active' => $_GET['active'], 'age' => $_GET['age']];
                echo json_encode("Person was created");
            } else json_encode($err, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "user/list":
        $statement = $db->prepare('SELECT * FROM Person limit 20 offset :page');
        if($statement) {
            $statement->bindValue(':page', $_GET['page']);
            $result = $statement->execute();
            if($result == true) {
                while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                }
            } else json_encode($err, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "user/view":
        $statement = $db->prepare('SELECT * FROM Person WHERE id = :id');
        $statement->bindValue(':id', $_GET['id']);
        $result = $statement->execute();
        while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
            echo $personJSON = json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        if (isset($res['id'])) {
            echo $errJSON = json_encode($err, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "user/search":
        if(isset($_GET['name'])){
            $value = $_GET['name'];
            $statement = $db->prepare("SELECT * FROM Person WHERE firstName LIKE '%" . $value . "%'");
            $results = $statement -> execute();
            while ($res = $results->fetchArray()) {
                if (isset($res['id'])) {
                    $row['firstName'] = $res['firstName'];
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode($err, JSON_UNESCAPED_UNICODE);
                }
            }
        }
        if(isset($_GET['phone'])){
            $value = $_GET['phone'];
            $statement = $db->prepare("SELECT * FROM Person WHERE phone LIKE '%" . $value . "%'");
            $results = $statement -> execute();
            while ($res = $results->fetchArray()) {
                if (isset($res['id'])) {
                    $row['phone'] = $res['phone'];
                    echo json_encode($res, JSON_UNESCAPED_UNICODE);
                } else {
                    echo json_encode($err, JSON_UNESCAPED_UNICODE);
                }
            }
        }

        break;
    case "user/edit":
        $statement = $db->prepare('UPDATE Person SET firstName = :firstName, lastName = :lastName, phone = :phone, active = :active, age = :age WHERE id =' . $_GET['id']);
        $statement->bindValue(':firstName', $_GET['firstName']);
        $statement->bindValue(':lastName', $_GET['lastName']);
        $statement->bindValue(':phone', $_GET['phone']);
        $statement->bindValue(':active', $_GET['active']);
        $statement->bindValue(':age', $_GET['age']);
        $result = $statement->execute();
        if ($result === true) {
            $personArray = ['firstName' => $_GET['firstName'], 'lastName' => $_GET['lastName'], 'phone' => $_GET['phone'],
                'active' => $_GET['active'], 'age' => $_GET['age']];
            echo json_encode($personArray, JSON_UNESCAPED_UNICODE);
        }
        break;
    case "user/delete":
        $sql1 = 'DELETE FROM Person WHERE id = ' . $_GET['id'];
        $sql2 = 'DELETE FROM Person_Interests WHERE personId = ' . $_GET['id'];
        $results1 = $db->query($sql1);
        $results2 = $db->query($sql2);
        echo json_encode("User was deleted.");
        break;
    case "interest/new":
        $statement = $db->prepare('INSERT INTO Interest(description) VALUES(:description)');
        if ($statement) {
            $statement->bindValue(':description', $_GET['description']);
            $result = $statement->execute();
        }
        echo $newInterestJSON = json_encode($statement, JSON_UNESCAPED_UNICODE);
        break;
    case "interest/view":
        $sql = 'SELECT * FROM Interest WHERE id = ' . $_GET['id'];
        $results = $db->query($sql);
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
        if ($result === true) {
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
        if(isset($_GET['name']) && isset($_GET['password'])){
            $statement = $db->prepare('SELECT * FROM Person WHERE id = :id');
            $statement->bindValue(':id', $_GET['id']);
            $result = $statement->execute();
        } else
            echo json_encode($err, JSON_UNESCAPED_UNICODE);
        break;
}