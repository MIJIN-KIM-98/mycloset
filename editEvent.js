/* ****************
 *  일정 편집
 * ************** */
var editEvent = function (event, element, view) {

    var urll="http://closet7.dothome.co.kr/21_05_18/"+event.description;
    $("#image>center>img").attr("src",urll);


    $('#deleteEvent').data('id', event._id); //클릭한 이벤트 ID

    $('.popover.fade.top').remove();
    $(element).popover("hide");

    if (event.allDay === true) {
        editAllDay.prop('checked', true);
    } else {
        editAllDay.prop('checked', false);
    }

    if (event.end === null) {
        event.end = event.start;
    }

    if (event.allDay === true && event.end !== event.start) {
        editEnd.val(moment(event.end).subtract(1, 'days').format('YYYY-MM-DD HH:mm'))
    } else {
        editEnd.val(event.end.format('YYYY-MM-DD HH:mm'));
    }

    modalTitle.html('일정 수정');
    editTitle.val(event.title);
    editStart.val(event.start.format('YYYY-MM-DD HH:mm'));
    editType.val(event.type);
    editMemo.val(event.memo);
    editWeather.val(event.weather);
    // editDesc.val(event.description);
    editColor.val(event.backgroundColor).css('color', event.backgroundColor);

    addBtnContainer.hide();
    modifyBtnContainer.show();
    eventModal.modal('show');

    //업데이트 버튼 클릭시
    $('#updateEvent').unbind();
    $('#updateEvent').on('click', function () {

        if (editStart.val() > editEnd.val()) {
            alert('끝나는 날짜가 앞설 수 없습니다.');
            return false;
        }

        if (editTitle.val() === '') {
            alert('일정명은 필수입니다.')
            return false;
        }

        var statusAllDay;
        var startDate;
        var endDate;
        var displayDate;

        if (editAllDay.is(':checked')) {
            statusAllDay = true;
            startDate = moment(editStart.val()).format('YYYY-MM-DD');
            endDate = moment(editEnd.val()).format('YYYY-MM-DD');
            displayDate = moment(editEnd.val()).add(1, 'days').format('YYYY-MM-DD');
        } else {
            statusAllDay = false;
            startDate = editStart.val();
            endDate = editEnd.val();
            displayDate = endDate;
        }

        eventModal.modal('hide');

        event.allDay = statusAllDay;
        event.title = editTitle.val();
        event.start = startDate;
        event.end = displayDate;
        event.type = editType.val();
        event.backgroundColor = editColor.val();
        event.description = editDesc.prop('files')[0];
        event.memo=editMemo.val();
        event.weather=editWeather.val();

        var eventData = {
            _id: event._id,
            title: editTitle.val(),
            start: editStart.val(),
            end: editEnd.val(),
            description: editDesc.prop('files')[0],
            type: editType.val(),
            username: '사나',
            backgroundColor: editColor.val(),
            textColor: '#ffffff',
            allDay: false,
            memo: editMemo.val(),
            weather:editWeather.val()
        };

        var form=document.getElementById('fileinfo');
        var form_data = new FormData(form);
        form_data.append('edit_id',event._id);

        $("#calendar").fullCalendar('updateEvent', event);

        //일정 업데이트
        $.ajax({
          type: "post",
          dataType: 'script',
          // cache: false,
          contentType: false,
          processData: false,
          url: "updateEvent.php",
          data: form_data,
            success: function (response) {
              if (response) {
                  $("#calendar").fullCalendar('updateEvent', event);
                  $('#calendar').fullCalendar('refetchEvents');
                  alert('일정이 수정되었습니다.');
              }
            }
        });

    });


// 삭제버튼
$('#deleteEvent').on('click', function () {

    let eventID = $(this).data('id');
    $('#deleteEvent').unbind();
    eventModal.modal('hide');

    //삭제시
    $.ajax({
      type: "post",
          url: "deleteEvent.php",
          data: { "eventID": eventID },
        success: function (response) {
          if(response){

            $("#calendar").fullCalendar('removeEvents', $(this).data('id'));
            $('#calendar').fullCalendar('refetchEvents');
            alert('일정이 삭제되었습니다.');


          }

        }
    });

});
};
