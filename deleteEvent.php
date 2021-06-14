<?php
session_start();
if (isset($_POST['eventID'])) {
    require_once 'dbController.php';
    $datas = $_POST['eventID'];
    $dbController = new dbController();
    $test = "DELETE FROM event WHERE _id={$datas} AND user_id='{$_SESSION['user_id']}' ";
    // 선택된 ID 값 받아서 해당 필드 삭제
    $result = $dbController->sql_exec("DELETE FROM event WHERE _id={$datas} AND user_id='{$_SESSION['user_id']}' ");

    echo $result;
}
