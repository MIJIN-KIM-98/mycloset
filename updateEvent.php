<?php
session_start();
require_once 'dbController.php';

$allday =intval($_POST['edit-allDay']);
$title = $_POST['edit-title'];
$start = $_POST['edit-start'];
$end = $_POST['edit-end'];
$type = $_POST['edit-type'];
$color = $_POST['color'];
$id = intval($_POST['edit_id']);
$memo = $_POST['edit-memo'];
$weather= $_POST['edit-weather'];

$textcolor ="#000000";


if(isset($_FILES['edit-desc']) && $_FILES['edit-desc']['name'] != ""){
  $target_directory = "files/";
  $target_file = $target_directory.basename($_FILES["edit-desc"]["name"]);

  if(move_uploaded_file($_FILES["edit-desc"]["tmp_name"],  $target_file)){
    $dbController = new dbController();
    $test = "UPDATE event SET title='{$title}',description='{$target_file}',start='{$start}'
            ,end='{$end}',backgroundColor='{$color}',textColor='{$textcolor}',allDay={$allday},type='{$type}',weather='{$weather}',memo='{$memo}' WHERE _id={$id} AND user_id='{$_SESSION['user_id']}' ";

    $result = $dbController->sql_exec("UPDATE event SET title='{$title}',description='{$target_file}',start='{$start}'
            ,end='{$end}',backgroundColor='{$color}',textColor='{$textcolor}',allDay={$allday},type='{$type}',weather='{$weather}',memo='{$memo}' WHERE _id={$id} AND user_id='{$_SESSION['user_id']}' ");
    echo 1;
  }else{echo 0;}
}else{

    $dbController = new dbController();
    $test = "UPDATE event SET title='{$title}',start='{$start}'
            ,end='{$end}',backgroundColor='{$color}',textColor='{$textcolor}',allDay={$allday},type='{$type}',weather='{$weather}',memo='{$memo}' WHERE _id={$id} AND user_id='{$_SESSION['user_id']}' ";

    $result = $dbController->sql_exec("UPDATE event SET title='{$title}',start='{$start}'
            ,end='{$end}',backgroundColor='{$color}',textColor='{$textcolor}',allDay={$allday},type='{$type}',weather='{$weather}',memo='{$memo}' WHERE _id={$id} AND user_id='{$_SESSION['user_id']}'");
    echo 1;
}


?>
