<?php
session_start();
if (isset($_POST['date'])) {
    require_once 'dbController.php';
    $date = $_POST['date'];
    $id=$POST['id'];

    $dbController = new dbController();
    $test = "SELECT * FROM event WHERE user_id='{$_SESSION['user_id']}' AND (start BETWEEN '{$date}-01' AND '{$date}-31' OR end BETWEEN '{$date}-01' AND '{$date}-31')";
    $datas = $dbController->sql_select("SELECT * FROM event WHERE user_id='{$_SESSION['user_id']}' AND (start BETWEEN '{$date}-01' AND '{$date}-31' OR end BETWEEN '{$date}-01' AND '{$date}-31')");
    if (!empty($datas)) {
        echo json_encode($datas);
    }
}
//date 값 받아와 월별로 event 뿌려줌
