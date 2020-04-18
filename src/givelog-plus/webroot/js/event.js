$('#eventAddModal').find('.save').on('click', function() {
    let obj = $('#eventAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: (id) ?  '/event/edit/' + id : '/event/add',
        type: 'POST',
        dataType: 'json',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'label_color': '#999999',       //TODO
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        if (location.pathname == '/gift/add') {
            addGiftEventSelectBox(data);
        } else {
            location.href = '/event';
        }

        obj.find('input[name="name"]').val(''),
        obj.modal('hide');
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
    let option = $('<option>').html(event['name']).val(event['id']);

    $('select[name="event_id"]').append(option);
    $('select[name="event_id"]').val(event['id']);
}