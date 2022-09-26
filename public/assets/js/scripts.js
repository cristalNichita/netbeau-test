$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function searchForm(event, elem) {
    event.preventDefault();

    let form = $(elem).closest('form');
    let method = $(form).attr('method');
    let action = $(form).attr('action');
    let value = $(form).find('input').val();

    $.ajax({
        url: action,
        method: method,
        dataType: 'json',
        data: {search: value},
        success: function (data) {
            console.log(data.data);
            $('.jobs-list-wrapper').html(data.data);
        }
    });
}

function updateJobs(event, elem) {
    event.preventDefault();

    let form = $(elem).closest('form');
    let method = $(form).attr('method');
    let action = $(form).attr('action');

    $.ajax({
        url: action,
        method: method,
        dataType: 'json',
        beforeSend: function() {
            $('.loader-bg').css('display', 'flex');
            $('body').css('overflow', 'hidden');
        },
        success: function () {
            window.location.href = '/';
        }
    });
}
