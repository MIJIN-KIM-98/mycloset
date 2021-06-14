<?php
session_start();

  $host = 'localhost';
  $db = 'closet7';
  $userid = 'closet7';
  $password = 'alwls071200**';
  $conn=mysqli_connect($host,$userid,$password,$db);
  if(mysqli_connect_errno($conn)){
    echo "데이터베이 연결 실패: ".mysqli_connect_errno();}


    if(!isset($_POST['tempArray'])&&isset($_POST['typeArray'])&&isset($_POST['weatherArray'])){
      $types=$_POST['typeArray'];
      $weathers=$_POST['weatherArray'];
      $typeStr = implode("', '", $types);
      $weatherStr = implode("', '", $weathers);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND type in ('$typeStr') AND weather in ('$weatherStr') ORDER BY start desc ");
    }
    if(!isset($_POST['typeArray'])&&isset($_POST['tempArray'])&&isset($_POST['weatherArray'])){
      $temps1=$_POST['tempArray'];
      $weathers1=$_POST['weatherArray'];
      $tempStr1 = implode("', '", $temps1);
      $weatherStr1 = implode("', '", $weathers1);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND title in ('$tempStr1') AND weather in ('$weatherStr1') ORDER BY start desc ");
    }
    if(!isset($_POST['weatherArray'])&&isset($_POST['typeArray'])&&isset($_POST['tempArray'])){
      $types2=$_POST['typeArray'];
      $temps2=$_POST['tempArray'];
      $tempStr2 = implode("', '", $temps2);
      $typeStr2 = implode("', '", $types2);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND title in ('$tempStr2') AND type in ('$typeStr2') ORDER BY start desc ");
    }
    if(!isset($_POST['tempArray'])&&!isset($_POST['typeArray'])&&isset($_POST['weatherArray'])){
      $weathers3=$_POST['weatherArray'];
      $weatherStr3 = implode("', '", $weathers3);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND weather in ('$weatherStr3') ORDER BY start desc ");
    }
    if(!isset($_POST['tempArray'])&&!isset($_POST['weatherArray'])&&isset($_POST['typeArray'])){
      $types3=$_POST['typeArray'];
      $typeStr4 = implode("', '", $types3);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND type in ('$typeStr4') ORDER BY start desc ");
    }
    if(!isset($_POST['typeArray'])&&!isset($_POST['weatherArray'])&&isset($_POST['tempArray'])){
      $temps3=$_POST['tempArray'];
      $tempStr5 = implode("', '", $temps3);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND title in ('$tempStr5') ORDER BY start desc ");
    }
    if(!isset($_POST['tempArray'])&& !isset($_POST['typeArray'])&& !isset($_POST['weatherArray'])){
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}'  ORDER BY start desc ");
    }
    if(isset($_POST['tempArray'])&& isset($_POST['typeArray'])&& isset($_POST['weatherArray'])){
      $temps4=$_POST['tempArray'];
      $types4=$_POST['typeArray'];
      $weathers4=$_POST['weatherArray'];
        $tempStr4 = implode("', '", $temps4);
        $typeStr4 = implode("', '", $types4);
        $weatherStr4 = implode("', '", $weathers4);
      $rest=mysqli_query($conn,"select * from event where user_id='{$_SESSION['user_id']}' AND title in ('$tempStr4') AND type in ('$typeStr4') AND weather in ('$weatherStr4') ORDER BY start desc ");
    }



        $output="";
        $output .="
        <table class='table table-bordered table-striped'>
          <tr>
            <th>날짜/시간</th>
            <th>날씨</th>
            <th>temp</th>
            <th>이미지</th>
            <th>allday</th>
            <th>구분</th>
            <th>메모</th>
          </tr>
        ";

        $urll="http://closet7.dothome.co.kr/21_06_03/";

        while($row=mysqli_fetch_array($rest)){
          $output .="
          <tr>
            <td>".$row["start"]."</td>
            <td>".$row["weather"]."</td>
            <td>".$row["title"]."</td>
            <td><img src='$urll".$row["description"]." ' width=100 height=100></td>
            <td>".$row["allDay"]."</td>
            <td>".$row["type"]."</td>
            <td>".$row["memo"]."</td>
          </tr>
          ";
        }
        echo $output;
        mysqli_close($conn);
