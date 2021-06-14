    <?php
    session_start();
    if (isset($_POST['temp'])&&isset($_POST['weather'])) {
      $host = 'localhost';
      $db = 'closet7';
      $userid = 'closet7';
      $password = 'alwls071200**';
      $conn=mysqli_connect($host,$userid,$password,$db);
      if(mysqli_connect_errno($conn)){
        echo "데이터베이 연결 실패: ".mysqli_connect_errno();}

        $temp = $_POST['temp'];
        $weather =$_POST['weather'];


        $weath="";

        if($weather=="Clear"){
            $weath="맑음";
        }else if($weather=="Snow"){
            $weath="눈";
        }else if($weather=="Rain"||$weather=="Thunderstorm"||$weather=="Drizzle"){
            $weath="비";
        }else{
            $weath="흐림";
        }

            $rest=mysqli_query($conn,"select * from event where title LIKE '%".$temp."%' AND type='적당함' AND user_id='{$_SESSION['user_id']}' AND weather='".$weath."' ORDER BY start desc ");

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
    }
