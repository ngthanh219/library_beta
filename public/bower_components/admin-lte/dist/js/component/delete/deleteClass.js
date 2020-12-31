var base_url = 'http://localhost:8082/php/QuanLyDiemDanh/';
function confirmAction() {
    return confirm("Bạn chắc chắn muốn xóa thông tin này?")
}

$('body').on('click', '.nutxoa', function(event) {
  if(confirmAction()==true){
    var id = $(this).attr('href');
    var ele = $(this).parent().parent();
    $.ajax({
      url: base_url+'ClassRoom/deleteClass/'+id,
      type: 'POST',
      dataType: 'json',
      data: {id: id},
    })
    .done(function(data) {
      if(data.response == 'no'){
        alert('Không thể xóa vì dữ liệu vẫn tồn tại ở danh sách điểm danh, môn học các lớp, danh sách sinh viên!');
      }else if(data.response == 'ok'){
        ele.remove();
      }
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function(data) {
      // console.log("complete");
    });
    return false;
  }else{
    return false;
  }
});