<?
require_once 'dbController.php';

$host = 'localhost';
$db = 'closet7';
$userid = 'closet7';
$password = 'alwls071200**';
$conn=mysqli_connect($host,$userid,$password,$db);
if(mysqli_connect_errno($conn)){
  echo "데이터베이 연결 실패: ".mysqli_connect_errno();
}


      $user_id = $_POST['UID'];
      $pwd = $_POST['UPWD'];
      $name = $_POST['UNAME'];
      $email = $_POST['UMail'];
      $r_date = date("Y-m-d H:i:s");
      $ip = $_SERVER['REMOTE_ADDR'];


      if($user_id == NULL){
      echo "Empty ID";
  }else if($pwd == NULL){
      echo "Empty PWD";
  }else if($name == NULL){
      echo "Empty NAME";
  }else if($email == NULL){
      echo "Empty EMAIL";
  }else{
      //회원 가입하고자 하는 아이디가 이미 존재하는지 확인
      $compare_sql = "SELECT user_id FROM uni_member WHERE user_id = '$user_id'";
      $compare_result = $conn->query($compare_sql);

      //DB에서 가져온 결과값이 1개 이상이고, 그 결과값이 입력한 ID와 같다면 DB에 존재하므로 다른 아이디로 시도...매세지 출력
      if($compare_result->num_rows == 1){

          //DB에서 가져온 결과값을 행렬로 변환 하여 DATA 접근
          $row=$compare_result->fetch_array(MYSQLI_ASSOC);
          if($row['user_id']==$user_id){
              echo "IDcheck";
          }
      }else{  //DB에 입력한 아이디와 동일한 아이디가 없다면 DB에 저장
          $sql = "INSERT INTO uni_member (user_id, pwd ,name, email, regdate, ip) VALUES ('$user_id',$pwd,'$name','$email','$r_date','$ip')";
          $result = $conn->query($sql);

          //저장 되었다면 성공, 아님 실패
          if($result){
              echo "Success save";
          }else{
              echo "Fail save";
          }
      }
  }

  mysqli_close($conn);
?>
