$('#eventAddModal').find('.save').on('click', function() {
    let obj = $('#eventAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: (id) ?  '/event/edit/' + id : '/event/add',
        type: 'POST',
        dataType: 'json',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'labelColor': '#999999',       //TODO
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        obj.find('input[name="name"]').val(''),
        obj.modal('hide');

        if (location.pathname == '/gift/add') {
            addGiftEventSelectBox(data);
        } else {
            location.href = '/event';
        }
    })
    .fail(function(data, textStatus) {
        if (data.status === 403) {
            location.href = '/login';
        } else if (data.status === 400) {
            console.log(data);
        } else {
            console.log(data);
        }
    });
});

$('#deleteConfirmModal').find('.delete').on('click', function() {
    let obj = $('#eventAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: '/event/delete/' + id,
        type: 'POST',
        dataType: 'json',
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        $('#deleteConfirmModal').modal('hide');
        obj.modal('hide');

        location.href = '/event';
    })
    .fail(function(data, textStatus) {
        if (data.status === 403) {
            location.href = '/login';
        } else if (data.status === 400) {
            console.log(data);
        } else {
            console.log(data);
        }
    });
});

function addGiftEventSelectBox(event) {
    let option = $('<option>').html(event['data']['name']).val(event['data']['id']);

    $('select[name="eventId"]').append(option);
    $('select[name="eventId"]').val(event['data']['id']);
}