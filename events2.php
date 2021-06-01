    <?php
    if (isset($_POST['temp'])) {
      $host = 'localhost';
      $db = 'closet7';
      $userid = 'closet7';
      $password = 'alwls071200**';
      $conn=mysqli_connect($host,$userid,$password,$db);
      if(mysqli_connect_errno($conn)){
        echo "데이터베이 연결 실패: ".mysqli_connect_errno();}

        // require_once 'dbController.php';
        $temp = $_POST['temp'];

        // $dbController = new dbController();
        // $test = "SELECT * FROM event";
        // $datas = $dbController->sql_select("SELECT * FROM event");


        // if (!empty($datas)) {
            // echo json_encode($datas);

            $rest=mysqli_query($conn,"select * from event where title LIKE '%".$temp."%' AND type='적당함' ");

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

            // $row=mysqli_fetch_array($rest);
            // if($row==NULL){
            //   echo "오늘 날씨에 해당하는 옷차림을 찾을 수 없습니다ㅜㅜ 더 많은 옷코디를 저장해보세요";
            //   mysqli_close($conn);
            // }else{

            //
            $urll="http://closet7.dothome.co.kr/21_05_18/";

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
          // }
        // }else{
        //   echo "잘못되었어 이건!";
        // }
    }
