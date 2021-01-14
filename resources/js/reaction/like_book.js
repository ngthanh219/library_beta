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
            if (res.like === true) {
                $('.reaction-like').addClass('liked');
            } else {
                count -= 1;
                $('.reaction-like').removeClass('liked');
            }
            $('#reaction-like').text('');
            $('#reaction-like').append(`<i class="icon-heart"></i> ${count} likes`);
        },
        error: function (XHR, status, error) {
            if (error == 'Unauthorized') {
                window.location.href = route + '/login';
            }
        },
        complete: function (res) {

        }
    })
})
