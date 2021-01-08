$('.add-to-cart').click(function(e) {
    e.preventDefault();

    var route = window.location.origin;
    var id = $(this).attr('href');

    $.ajax({
        url: route + '/add-cart/' + id,
        type: 'GET',
        dataType: 'json',
        data: {
            id: id
        },
        success: function(res) {
            var html = '<div class="content-message">' + res.message + '</div>';
            $('.notification-client').append(html);
            $('.content-message').delay(2500).slideUp();
            setTimeout(function() {
                $('.notification-client').empty();
            }, 60000)
        },
        error: function(XHR, status, error) {
            console.log(error);
        },
        complete: function(res) {
            // alert(data);
        }
    })

})