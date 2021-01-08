$('.l-react').click(function (e) {
    e.preventDefault();
    var id = $(this).attr('href');
    var route = window.location.origin;

    $.ajax({
        url: route + '/react/' + id,
        type: 'get',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (res) {
            var count = res.count;
            console.log(count);
            if (res.like === true) {
                $('.reaction-like').addClass('liked');
                $('#reaction-like').text('');
                $('#reaction-like').append('<i class="icon-thumbs-up"></i> ' + count + ' likes');
            } else {
                count-=1;
                $('.reaction-like').removeClass('liked');
                $('#reaction-like').text('');
                $('#reaction-like').append('<i class="icon-thumbs-up"></i> ' + count + ' likes');
            }
        },
        error: function (XHR, status, error) {
            console.log(error);
        },
        complete: function (res) {

        }
    })
})
