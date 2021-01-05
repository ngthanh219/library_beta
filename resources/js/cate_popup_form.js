function removeClass() {
    $('#cate-f').removeClass('show');
    setTimeout(function() {
        $('#cate-f').empty();
    }, 500)
}

$(document).ready(function() {
    $('#off-form').click(function() {
        removeClass();
    })
});

$('#form').submit(function(e) {
    e.preventDefault();
    var url = window.location.origin + '/category';
    var parent_name = $('#parent_name').val();
    var child_name = $('#child_name').val();
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            '_token': '{{ csrf_token() }}',
            'parent_name': parent_name,
            'child_name': child_name,
        },
        success: function(res) {
            var html = '<option value="' + res.dataChild.id + '">' + res.dataChild.name +
                '</option>';
            $('#category_id').append(html);
            removeClass();
        },
        error: function(error) {
            console.log(error);
        },
        complete: function(res) {
            // alert(data);
        }
    })
});
