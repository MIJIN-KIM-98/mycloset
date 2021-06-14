    <?

    session_start();

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

      $sql = "SELECT user_id,pwd FROM uni_member where user_id = '$user_id'";

      //Query문 결과 result변수에 저장
      $result = $conn->query($sql);

        //Query문 결과로 가져온 값이 한 줄이라도 있다면 true, 아니면 false
        if($result->num_rows==1){

            //가져온 data를 행열로 바꾸어줌, table의 컬럼명으로 data에 접근하는것을 쉽게 하기위해서...
            $row=$result->fetch_array(MYSQLI_ASSOC);

            //login.html에서 입력한 비번과 db에 들어있는 비번이 같은지 비교
            if($row['pwd']==$pwd){

                //같다면 아이디를 session에 저장
                $_SESSION['user_id']=$user_id;

                //성공적으로 저장 했다면 main으로 이동, 저장 실패면 login화면으로 다시 이동
                if(isset($_SESSION['user_id'])){
                    //성공
                    echo "success";
                }else{
                    //실패 : session저장 실패
                    echo "Fail:session";
                }
            }else{
                //실패 : 비번이 같지 않음
                echo "Fail:password";
            }
        }else{
            //실패 : db에 아이디 존재하지 않음
            echo"Fail:empty";
        }
        mysqli_close($conn);
      ?>
