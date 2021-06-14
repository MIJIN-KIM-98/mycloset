var eventModal = $('#eventModal');
var modalTitle = $('.modal-title');
var editAllDay = $('#edit-allDay');
var editTitle = $('#edit-title');
var editStart = $('#edit-start');
var editEnd = $('#edit-end');
var editType = $('#edit-type');
var editColor = $('#edit-color');
var editDesc = $('#edit-desc');
var editWeather=$('#edit-weather');
var editMemo=$('#edit-memo');

var addBtnContainer = $('.modalBtnContainer-addEvent');
var modifyBtnContainer = $('.modalBtnContainer-modifyEvent');


/* ****************
 *  새로운 일정 생성
 * ************** */
var newEvent = function (start, end, eventType) {

    $("#contextMenu").hide(); //메뉴 숨김

   // ADD_MODAL
    modalTitle.html('새로운 일정');
    editType.val(eventType).prop('selected', true);
    editTitle.val('');
    editStart.val(start);
    editEnd.val(end);
    editTitle.val();
    editMemo.val();
    editWeather.val();

    addBtnContainer.show();
    modifyBtnContainer.hide();
    eventModal.modal('show');


    //새로운 일정 저장버튼 클릭
    $('#save-event').unbind();
    $('#save-event').on('click', function () {

        var eventData = {
            title: editTitle.val(),
            start: editStart.val(),
            end: editEnd.val(),
            description: editDesc.prop('files')[0],
            type: editType.val(),
            username: '사나',
            backgroundColor: editColor.val(),
            textColor: '#ffffff',
            allDay: false,
            weather: editWeather.val(),
            memo:editMemo.val()
        };

          var title = editTitle.val();
          var start = editStart.val();
          var end = editEnd.val();
          var description = $( '#edit-desc' ).prop('files')[0];
          var type= editType.val();
          var username= '사나';
          var backgroundColor= editColor.val();
          var textColor= '#ffffff';
          var allDay= false;
          var weather=editWeather.val();
          var memo=editMemo.val();

          var form=document.getElementById('fileinfo');
          var form_data = new FormData(form);

        if (eventData.start > eventData.end) {
            alert('끝나는 날짜가 앞설 수 없습니다.');
            return false;
        }

        if (eventData.title === '') {
            alert('일정명은 필수입니다.');
            return false;
        }

        var realEndDay;

        if (editAllDay.is(':checked')) {
            eventData.start = moment(eventData.start).format('YYYY-MM-DD');
            //render시 날짜표기수정
            eventData.end = moment(eventData.end).add(1, 'days').format('YYYY-MM-DD');
            //DB에 넣을때(선택)
            realEndDay = moment(eventData.end).format('YYYY-MM-DD');

            eventData.allDay = true;
        }

        $("#calendar").fullCalendar('renderEvent', eventData, true);
        eventModal.find('input, file').val('');
        editAllDay.prop('checked', false);
        eventModal.modal('hide');

        //새로운 일정 저장
        $.ajax({
          type: "post",
          dataType: 'script',
          contentType: false,
          processData: false,
          url: "addEvent.php",
          data: form_data,
            success: function (response) {
              if(response==1){
              $('#calendar').fullCalendar('removeEvents');
              $('#calendar').fullCalendar('refetchEvents');
                alert('일정이 추가 되었습니다.');
              $('#calendar').fullCalendar('refetchEvents');
              }else if(response==0){
                alert("그림이 파일로 이동하지 못했다.");
              }
            }
        });
    });
};
