var base_url = 'http://localhost:8082/php/QuanLyDiemDanh/';
function confirmAction() {
    return confirm("Bạn chắc chắn muốn xóa thông tin này?")
}

$('body').on('click', '.nutxoa', function(event) {
  if(confirmAction()==true){
    var id = $(this).attr('href');
    $(this).parent().parent().remove();
    $.ajax({
      url: base_url+'Support/deleteSupport/'+id,
      type: 'POST',
      dataType: 'json',
      data: {id: id},
    })
    .done(function() {
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function() {
      // console.log("complete");
    });
    return false;
  }else{
    return false;
  }
});