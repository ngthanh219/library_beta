$('.vote').click(function () {
    var route = window.location.origin;
    var vote = $(this).attr('value');
    var book_id = $('#book_id').text();

    $.ajax({
        url: route + '/vote',
        type: 'GET',
        dataType: 'json',
        data: {
            book_id: book_id,
            vote: vote
        },
        success: function (res) {
            
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
