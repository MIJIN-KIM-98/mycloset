<?
    session_start();
    require_once 'dbController.php';

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>My closet</title>
    <style>
        .text-right{text-align:center;
        vertical-align: middle;}

        input {
			padding: 10px 20px;
			margin: 20px 0;
			box-sizing: border-box;
		}
    img{
      margin-top: 200px;

    }
    </style>
    <script src="vendor/js/jquery.min.js"></script>

    <script type="text/javascript">
        //jQuery 문법
        $(document).ready(function(){
          var u_id=$('#id');
            $('#box2').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url:"loginProc.php",
                    data : $(this).serialize(),
                    success : function(response){
                    if($.trim(response)=="success"){
                      alert("로그인 성공");
                      location.replace('http://closet7.dothome.co.kr/21_06_03/main.php');
                    }
                    else if($.trim(response)=="Fail:session"){
                        alert("세션 저장 실패...다시 시도 해주세요.");
                    }
                    else if($.trim(response)=="Fail:password"){
                        alert("비밀번호가 틀렸습니다. 다시 시도 해주세요.");
                    }
                    else if($.trim(response)=="Fail:empty"){
                        alert("회원 정보가 없습니다. 회원가입을 해주세요.");
                    }
                },
                    error : function(xtr,status,error){
                        alert(xtr +":"+status+":"+error);
                    }
                });
            });
        });
        </script>
</head>
<body>

<div class="text-right">

<img src="./image/image.jpg" alt="">
  <form id = "box2" method="POST">
          <table align="center">
          <tr>
              <td>아이디</td>
              <td><input type ="text" name = "UID" id="id" placeholder="Enter Your Email"></td>
          </tr>
          <tr>
              <td>비밀번호</td>
              <td><input type ="text" name = "UPWD" placeholder="Enter Your Password"></td>
          </tr>
          </table>
          <input type ="submit" value="로그인">
  </form>
          <a href="join2.html">회원가입</a>


</div>


</body>
</html>
