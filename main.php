<?
    session_start();
    require_once 'dbController.php';

?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>mycloset</title>
    <link rel=" shortcut icon" href="image/favicon.ico">

    <link rel="stylesheet" href="vendor/css/fullcalendar.min.css" />
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href='vendor/css/select2.min.css' />
    <link rel="stylesheet" href='vendor/css/bootstrap-datetimepicker.min.css' />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="css/main.css">

</head>

<body>
  <!-- 일정 클릭시 해당 일정 이미지가 출력되는 부분 -->
    <div id="image" style="width:35%; height:840px; float:right; z-index: 2;" >
      <center><img src="" width="100%" height="100%" alt="클릭된 일정의 이미지가 표시됩니다." style="margin-top: 100px; margin-bottom: 1000px;"></center>
    </div>
    <div class="container" style="width:60%; float:left; z-index: 1;">
        <!-- 일자 클릭시 메뉴오픈 -->
        <div id="contextMenu" class="dropdown clearfix">
            <ul class="dropdown-menu dropNewEvent" role="menu" aria-labelledby="dropdownMenu"
                style="display:block;position:static;margin-bottom:5px;">
                <li><a tabindex="-1" href="#">추움</a></li>
                <li><a tabindex="-1" href="#">적당함</a></li>
                <li><a tabindex="-1" href="#">더움</a></li>
                <li><a tabindex="-1" href="#">미정</a></li>
                <!-- <li><a tabindex="-1" href="#">카테고리4</a></li> -->
                <li class="divider"></li>
                <li><a tabindex="-1" href="#" data-role="close">Close</a></li>
            </ul>
        </div>

        <div id="wrapper">
          <div class="row">
            <!-- 오픈 API를 사용하여 위치와 기온 나타냄 -->
             지금 <B><span id="city"></span></B>의 날씨는 <B><span id="weath"></span></B> 이고 기온은 <B><span id="temp"></span></B> 입니다. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <!-- 지난 날씨보기 -->
           <button type="button" id="bnt" onclick="location.href='https://www.kweather.co.kr/kma/kma_past.html?' ">지난 날씨보기</button>
           <!-- 일주일 예보 -->
           <button class="forecast" id="bnt">날씨 7일간 예보보기</button>
           <!-- 일주일 예보 버튼 클릭 했을 때 나타나는 모달창 -->
           <div class="modal" id="forecast_modal">
               <div class="modal_content" id="forecast_content" title="클릭하면 창이 닫힙니다.">
                    <table align="center">
                      <thead>
                        <tr>
                          <td><B>날짜</B></td>
                          <td><B>날씨</B></td>
                          <td><B>아침 온도</B></td>
                          <td><B>낮 온도</B></td>
                          <td><B>오후 온도</B></td>
                          <td><B>밤 온도</B></td>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
               </div>
           </div>
           <!-- 오늘의 기온을 기반으로 옷추천해주는 버튼 -->
           <button class="recommendation" id="bnt">오늘의 날씨를 위한 추천 코디!</button>
           <!-- 오늘의 날씨를 위한 추천 코디 버튼을 눌렀을때 나타나는 모달창 -->
           <div class="modal" id="recommendation_modal">
               <div class="modal_content" id="recommendation_content" title="클릭하면 창이 닫힙니다.">
               </div>
           </div>

               <span style='margin-left:100px'><a href="logOut.php">로그아웃 </a></span>

          </div>
            <div id="loading"></div>
            <div id="calendar"></div>
        </div>



      <form enctype="multipart/form-data" method="post" name="fileinfo" id="fileinfo" class="fileinfo">
        <!-- 일정 추가 MODAL -->
        <div class="modal fade" tabindex="-1" role="dialog" id="eventModal">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-allDay">하루종일</label>
                                <input class='allDayNewEvent' id="edit-allDay" name="edit-allDay" type="checkbox"></label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-title">기온</label>
                                <select class="inputModal" name="edit-title" id="edit-title">
                                  <option value="기온-40">-40 °C</option>
                                  <option value="기온-39">-39 °C</option>
                                  <option value="기온-38">-38 °C</option>
                                  <option value="기온-37">-37 °C</option>
                                  <option value="기온-36">-36 °C</option>
                                  <option value="기온-35">-35 °C</option>
                                  <option value="기온-34">-34 °C</option>
                                  <option value="기온-33">-33 °C</option>
                                  <option value="기온-32">-32 °C</option>
                                  <option value="기온-31">-31 °C</option>
                                  <option value="기온-30">-30 °C</option>
                                  <option value="기온-29">-29 °C</option>
                                  <option value="기온-28">-28 °C</option>
                                  <option value="기온-27">-27 °C</option>
                                  <option value="기온-26">-26 °C</option>
                                  <option value="기온-25">-25 °C</option>
                                  <option value="기온-24">-24 °C</option>
                                  <option value="기온-23">-23 °C</option>
                                  <option value="기온-22">-22 °C</option>
                                  <option value="기온-21">-21 °C</option>
                                  <option value="기온-20">-20 °C</option>
                                  <option value="기온-19">-19 °C</option>
                                  <option value="기온-18">-18 °C</option>
                                  <option value="기온-17">-17 °C</option>
                                  <option value="기온-16">-16 °C</option>
                                  <option value="기온-15">-15 °C</option>
                                  <option value="기온-14">-14 °C</option>
                                  <option value="기온-13">-13 °C</option>
                                  <option value="기온-12">-12 °C</option>
                                  <option value="기온-11">-11 °C</option>
                                  <option value="기온-10">-10 °C</option>
                                  <option value="기온-9">-9 °C</option>
                                  <option value="기온-8">-8 °C</option>
                                  <option value="기온-7">-7 °C</option>
                                  <option value="기온-6">-6 °C</option>
                                  <option value="기온-5">-5 °C</option>
                                  <option value="기온-4">-4 °C</option>
                                  <option value="기온-3">-3 °C</option>
                                  <option value="기온-2">-2 °C</option>
                                  <option value="기온-1">-1 °C</option>
                                  <option value="기온0">0 °C</option>
                                  <option value="기온1">1 °C</option>
                                  <option value="기온2">2 °C</option>
                                  <option value="기온3">3 °C</option>
                                  <option value="기온4">4 °C</option>
                                  <option value="기온5">5 °C</option>
                                  <option value="기온6">6 °C</option>
                                  <option value="기온7">7 °C</option>
                                  <option value="기온8">8 °C</option>
                                  <option value="기온9">9 °C</option>
                                  <option value="기온10">10 °C</option>
                                  <option value="기온11">11 °C</option>
                                  <option value="기온12">12 °C</option>
                                  <option value="기온13">13 °C</option>
                                  <option value="기온14">14 °C</option>
                                  <option value="기온15">15 °C</option>
                                  <option value="기온16">16 °C</option>
                                  <option value="기온17">17 °C</option>
                                  <option value="기온18">18 °C</option>
                                  <option value="기온19">19 °C</option>
                                  <option value="기온20">20 °C</option>
                                  <option value="기온21">21 °C</option>
                                  <option value="기온22">22 °C</option>
                                  <option value="기온23">23 °C</option>
                                  <option value="기온24">24 °C</option>
                                  <option value="기온25">25 °C</option>
                                  <option value="기온26">26 °C</option>
                                  <option value="기온27">27 °C</option>
                                  <option value="기온28">28 °C</option>
                                  <option value="기온29">29 °C</option>
                                  <option value="기온30">30 °C</option>
                                  <option value="기온31">31 °C</option>
                                  <option value="기온32">32 °C</option>
                                  <option value="기온33">33 °C</option>
                                  <option value="기온34">34 °C</option>
                                  <option value="기온35">35 °C</option>
                                  <option value="기온36">36 °C</option>
                                  <option value="기온37">37 °C</option>
                                  <option value="기온38">38 °C</option>
                                  <option value="기온39">39 °C</option>
                                  <option value="기온40">40 °C</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-weather">날씨</label>
                                <select class="inputModal" name="edit-weather" id="edit-weather">
                                  <option value="맑음">맑음</option>
                                  <option value="흐림">흐림</option>
                                  <option value="비">비</option>
                                  <option value="눈">눈</option>
                                </select>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-start">시작</label>
                                <input class="inputModal" type="text" name="edit-start" id="edit-start" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-end">끝</label>
                                <input class="inputModal" type="text" name="edit-end" id="edit-end" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-type">구분</label>
                                <select class="inputModal" type="text" name="edit-type" id="edit-type">
                                    <option value="추움">추움</option>
                                    <option value="적당함">적당함</option>
                                    <option value="더움">더움</option>
                                    <option value="미정">미정</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-color">색상</label>
                                <select class="inputModal" name="color" id="edit-color">
                                    <option value="#D25565" style="color:#D25565;">빨간색</option>
                                    <option value="#9775fa" style="color:#9775fa;">보라색</option>
                                    <option value="#ffa94d" style="color:#ffa94d;">주황색</option>
                                    <option value="#74c0fc" style="color:#74c0fc;">파란색</option>
                                    <option value="#f06595" style="color:#f06595;">핑크색</option>
                                    <option value="#63e6be" style="color:#63e6be;">연두색</option>
                                    <option value="#a9e34b" style="color:#a9e34b;">초록색</option>
                                    <option value="#4d638c" style="color:#4d638c;">남색</option>
                                    <option value="#495057" style="color:#495057;">검정색</option>
                                    <option value="#ffffff" style="color:#000000;">흰색</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="col-xs-4" for="edit-desc">이미지</label>
                                    <input type="file" name="edit-desc" class="inputModal" value="" id="edit-desc">
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12">
                               <label class="col-xs-4" for="edit-memo">설명</label>
                               <textarea rows="4" cols="50" class="inputModal" name="edit-memo"
                                   id="edit-memo"></textarea>
                           </div>
                       </div>

                    </div>
                    <div class="modal-footer modalBtnContainer-addEvent">
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                        <button type="button" class="btn btn-primary" id="save-event">저장</button>
                    </div>
                    <div class="modal-footer modalBtnContainer-modifyEvent">
                        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                        <button type="button" class="btn btn-danger" id="deleteEvent">삭제</button>
                        <button type="button" class="btn btn-primary" id="updateEvent">저장</button>
                    </div>
                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      </form>

        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">필터</h3>
            </div>

            <!-- 필터 -->
            <div class="panel-body">

                <div class="col-lg-6">
                    <label for="calendar_view">구분별</label>
                    <div class="input-group">
                        <select class="filter" id="type_filter" multiple="multiple">
                            <option value="추움">추움</option>
                            <option value="적당함">적당함</option>
                            <option value="더움">더움</option>
                            <option value="더움">미정</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <label for="calendar_view">날씨별</label>
                    <div class="input-group">
                        <select class="filter" id="weather_filter" multiple="multiple">
                            <option value="맑음">맑음</option>
                            <option value="흐림">흐림</option>
                            <option value="비">비</option>
                            <option value="눈">눈</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <label for="calendar_view">기온별</label>
                    <div class="input-group">
                      <select class="filter" id="temp_filter" multiple="multiple">
                        <option value="기온-40">-40 °C</option>
                        <option value="기온-39">-39 °C</option>
                        <option value="기온-38">-38 °C</option>
                        <option value="기온-37">-37 °C</option>
                        <option value="기온-36">-36 °C</option>
                        <option value="기온-35">-35 °C</option>
                        <option value="기온-34">-34 °C</option>
                        <option value="기온-33">-33 °C</option>
                        <option value="기온-32">-32 °C</option>
                        <option value="기온-31">-31 °C</option>
                        <option value="기온-30">-30 °C</option>
                        <option value="기온-29">-29 °C</option>
                        <option value="기온-28">-28 °C</option>
                        <option value="기온-27">-27 °C</option>
                        <option value="기온-26">-26 °C</option>
                        <option value="기온-25">-25 °C</option>
                        <option value="기온-24">-24 °C</option>
                        <option value="기온-23">-23 °C</option>
                        <option value="기온-22">-22 °C</option>
                        <option value="기온-21">-21 °C</option>
                        <option value="기온-20">-20 °C</option>
                        <option value="기온-19">-19 °C</option>
                        <option value="기온-18">-18 °C</option>
                        <option value="기온-17">-17 °C</option>
                        <option value="기온-16">-16 °C</option>
                        <option value="기온-15">-15 °C</option>
                        <option value="기온-14">-14 °C</option>
                        <option value="기온-13">-13 °C</option>
                        <option value="기온-12">-12 °C</option>
                        <option value="기온-11">-11 °C</option>
                        <option value="기온-10">-10 °C</option>
                        <option value="기온-9">-9 °C</option>
                        <option value="기온-8">-8 °C</option>
                        <option value="기온-7">-7 °C</option>
                        <option value="기온-6">-6 °C</option>
                        <option value="기온-5">-5 °C</option>
                        <option value="기온-4">-4 °C</option>
                        <option value="기온-3">-3 °C</option>
                        <option value="기온-2">-2 °C</option>
                        <option value="기온-1">-1 °C</option>
                        <option value="기온0">0 °C</option>
                        <option value="기온1">1 °C</option>
                        <option value="기온2">2 °C</option>
                        <option value="기온3">3 °C</option>
                        <option value="기온4">4 °C</option>
                        <option value="기온5">5 °C</option>
                        <option value="기온6">6 °C</option>
                        <option value="기온7">7 °C</option>
                        <option value="기온8">8 °C</option>
                        <option value="기온9">9 °C</option>
                        <option value="기온10">10 °C</option>
                        <option value="기온11">11 °C</option>
                        <option value="기온12">12 °C</option>
                        <option value="기온13">13 °C</option>
                        <option value="기온14">14 °C</option>
                        <option value="기온15">15 °C</option>
                        <option value="기온16">16 °C</option>
                        <option value="기온17">17 °C</option>
                        <option value="기온18">18 °C</option>
                        <option value="기온19">19 °C</option>
                        <option value="기온20">20 °C</option>
                        <option value="기온21">21 °C</option>
                        <option value="기온22">22 °C</option>
                        <option value="기온23">23 °C</option>
                        <option value="기온24">24 °C</option>
                        <option value="기온25">25 °C</option>
                        <option value="기온26">26 °C</option>
                        <option value="기온27">27 °C</option>
                        <option value="기온28">28 °C</option>
                        <option value="기온29">29 °C</option>
                        <option value="기온30">30 °C</option>
                        <option value="기온31">31 °C</option>
                        <option value="기온32">32 °C</option>
                        <option value="기온33">33 °C</option>
                        <option value="기온34">34 °C</option>
                        <option value="기온35">35 °C</option>
                        <option value="기온36">36 °C</option>
                        <option value="기온37">37 °C</option>
                        <option value="기온38">38 °C</option>
                        <option value="기온39">39 °C</option>
                        <option value="기온40">40 °C</option>
                      </select>
                    </div>
                </div>

                <button class="filter_btn" id="filter_btn">필터링 결과</button>
                  <div class="modal" id="filter_modal">
                      <div class="modal_content" id="filter_content" title="클릭하면 창이 닫힙니다.">

                      </div>
                  </div>
            </div>
        </div>

            </div>
        </div>
        <!-- /.filter panel -->
    </div>
    <!-- /.container -->

    <script src="vendor/js/jquery.min.js"></script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/moment.min.js"></script>
    <script src="vendor/js/fullcalendar.min.js"></script>
    <script src="vendor/js/ko.js"></script>
    <script src="vendor/js/select2.min.js"></script>
    <script src="vendor/js/bootstrap-datetimepicker.min.js"></script>
    <script src="main.js"></script>
    <script src="addEvent.js"></script>
    <script src="editEvent.js"></script>
    <script src="etcSetting.js"></script>

    <script>
  $(document).ready(function () {


      //예보 모달창 열고 닫기
      $(".forecast").click(function(){
      $("#forecast_modal").fadeIn();
    });

    $("#forecast_content").click(function(){
      $("#forecast_modal").fadeOut();
    });

    //오늘의 날씨를 위한 추천 코디! 모달창 누르면 모달창 닫힘
    $("#recommendation_content").click(function(){
      $("#recommendation_modal").fadeOut();
    });

      //필터링 결과 모달창 누르면 모달창 닫힘
    $("#filter_content").click(function(){
      $("#filter_modal").fadeOut();
    });

    // 필터링 결과 버튼 눌렀을때
    $(".filter_btn").click(function(){
    $("#filter_modal").fadeIn();

    var tempArray=[];
    var typeArray=[];
    var weatherArray=[];

    $('#temp_filter option:selected').each(function(i){//체크된 리스트 저장
                        tempArray.push($(this).val());
                    });

    $('#type_filter option:selected').each(function(i){//체크된 리스트 저장
                        typeArray.push($(this).val());
                    });

    $('#weather_filter option:selected').each(function(i){//체크된 리스트 저장
                        weatherArray.push($(this).val());
                    });

    $.ajax({
      type: "post",
      url: "filter.php",
      data: {
      "tempArray" : tempArray,
      "typeArray" : typeArray,
      "weatherArray" : weatherArray
    },
      success: function (response) {
        if(!response)
          {
            return;
            console.log("filter링 된 결과를 받아오지 못하였다.");
          }
          $("#filter_content").html(response);
      }
      ////success
    });

    });


    // 현재 위치와 기온 가져오기
    var Ip = "https://ipinfo.io/json";

    $.getJSON(Ip, function (data) {
      var city = data.city;
      var region = data.region;
      var country = data.country;
      console.log(city);

      var KEY = "&APPID=e96a3930bc0760250075575a396a67ff";

      var URL =
        "http://api.openweathermap.org/data/2.5/weather?q=" +
        city +
        "," +
        country +
        KEY;

        var URL2 ="https://api.openweathermap.org/data/2.5/onecall?lat=37.5683&lon=126.9778&exclude=current,minutely,hourly,alerts&appid=e96a3930bc0760250075575a396a67ff";


    $.getJSON(URL, function (data) {
        var type = data.weather[0].main; //array 0 index
        var id = data.weather[0].id; //array 0 index
        var city = data.name;

        var tempCel = Math.round(data.main.temp - 273.15);
        var tempC = tempCel + "°C";
        var weather = data.weather[0].description;
        var tempBool = true;

        $("#city").text(city);
        $("#temp").text(tempC);

        if(type=="Clear"){
            $("#weath").text("맑음");
        }else if(type=="Snow"){
            $("#weath").text("눈");
        }else if(type=="shower rain"||type=="Rain"||type=="Thunderstorm"||type=="Drizzle"){
              $("#weath").text("비");
        }else {
            $("#weath").text("흐림");
        }

        $(".recommendation").click(function(){
        $("#recommendation_modal").fadeIn();

        $.ajax({
          type: "post",
          url: "events2.php",
          data: {"temp":tempCel,
                "weather":type
        },
          success: function (response) {
            if(!response)
              {
                return;
              }
              $("#recommendation_content").html(response);
          }
          ////success
        });

      });


      });

      /////URL1끝

      // 일주일 예보 가져오기
      $.getJSON(URL2, function (data) {
        for(var i=0;i<8;i++){
          var ctime=data.daily[i].dt;
          var mtemp=(data.daily[i].temp.morn-273.15).toFixed(0);
          var dtemp=(data.daily[i].temp.day-273.15).toFixed(0);
          var etemp=(data.daily[i].temp.eve-273.15).toFixed(0);
          var ntemp=(data.daily[i].temp.night-273.15).toFixed(0);
          var type = data.daily[i].weather[0].main;

          if(type=="Clear"){
              type="맑음";
          }else if(type=="Snow"){
              type="눈";
          }else if(type=="shower rain"||type=="Rain"||type=="Thunderstorm"||type=="Drizzle"){
              type="비";
          }else {
              type="흐림";
          }


          function convertTime(t){
            var ot=new Date(t*1000);
            var dt=ot.getDate();

            return dt+"일"
          }

          var currentTime= convertTime(ctime);

          var tableHtml="<tr>"+
                          "<td>"+currentTime+"</td>"+
                          "<td>"+type+"</td>"+
                          "<td>"+mtemp+"</td>"+
                          "<td>"+dtemp+"</td>"+
                          "<td>"+etemp+"</td>"+
                          "<td>"+ntemp+"</td>"+
                        "</tr>";
          $('#forecast_content tbody').append(tableHtml);
        }

        });

    });


  });
  </script>
</body>

</html>
