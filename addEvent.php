<?php
require_once 'dbController.php';
session_start();

$allday =intval($_POST['edit-allDay']); //정수로 바꿔줌
$title = $_POST['edit-title'];
$start = $_POST['edit-start'];
$end = $_POST['edit-end'];
$type = $_POST['edit-type'];
$color = $_POST['color'];
$weather=$_POST['edit-weather'];
$memo=$_POST['edit-memo'];
$textcolor ="#000000";

$testVal = "테스트 데이터";

  $target_directory = "files/";
  $target_file = $target_directory.basename($_FILES["edit-desc"]["name"]); //db에 저장될 file 경로 ex)files/파일이름.파일확장자

  if(move_uploaded_file($_FILES["edit-desc"]["tmp_name"],  $target_file)){ //파일을 targiet_file 경로로 이동
    $dbController = new dbController(); //db 연결

    $test = "INSERT INTO event(title,description,start,end,backgroundColor,textColor,allDay,type,weather,memo,user_id)
    VALUES('$title','$target_file','$start','$end','$color','$textcolor',$allday,'$type','$weather','$memo','{$_SESSION['user_id']}')";

    //ADD_MODAL에서 받은 데이터 값 db에 저장
    $result = $dbController->sql_exec("INSERT INTO event(title,description,start,end,backgroundColor,textColor,allDay,type,weather,memo,user_id)
                                        VALUES('$title','$target_file','$start','$end','$color','$textcolor',$allday,'$type','$weather','$memo','{$_SESSION['user_id']}')");
    echo 1;
  }else{echo 0;}


?>
