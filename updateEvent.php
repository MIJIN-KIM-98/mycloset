<?php
require_once 'dbController.php';

$id = $_POST['id'];
$allday =intval($_POST['edit-allDay']);
$title = $_POST['edit-title'];
$start = $_POST['edit-start'];
$end = $_POST['edit-end'];
$type = $_POST['edit-type'];
$color = $_POST['color'];
$textcolor ="#000000";

$target_directory = "files/";
$target_file = $target_directory.basename($_FILES["edit-desc"]["name"]);

$dbController = new dbController();
$test = "UPDATE event SET title='$title',description='$target_file',start='$start'
        ,end='$end',backgroundColor='$color',textColor='$textcolor',allDay=$allday,type='$type' WHERE _id='$id' ";

$result = $dbController->sql_exec("UPDATE event SET title='$title',description='$target_file',start='$start'
        ,end='$end',backgroundColor='$color',textColor='$textcolor',allDay=$allday,type='$type' WHERE _id='$id' ");

echo $result;
// if (!empty($datas)) {
//     echo json_encode($datas);
// }

  ?>
