<?php
require_once 'dbController.php';

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
  if(move_uploaded_file($_FILES["edit-desc"]["tmp_name"],  $target_file)){
    // $dbController = new dbController();
    $test = "INSERT INTO event(title,description,start,end,backgroundColor,textColor,allDay,type)
    VALUES('$title','$target_file','$start','$end','$color','$textcolor',$allday,'$type')";
    // $test = "SELECT * FROM event WHERE start BETWEEN '" . $date . "-01' AND '" . $date . "-31'";
    $result = $dbController->sql_exec("INSERT INTO event(title,description,start,end,backgroundColor,textColor,allDay,type)
                                        VALUES('$title','$target_file','$start','$end','$color','$textcolor',$allday,'$type')");
    echo 1;
  }else{echo 0;}


?>
