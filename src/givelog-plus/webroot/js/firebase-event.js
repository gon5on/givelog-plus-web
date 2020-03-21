$('#eventAddModal').find('.save').on('click', function() {
    let obj = $('#eventAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: (id) ?  '/event/edit/' + id : '/event/add',
        type: 'POST',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'label_color': '#999999',       //TODO
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        location.href = '/event';
        obj.modal('hide');  
    })
    .fail(function(data, textStatus, xhr) {
        if (xhr.status === 403) {
            location.href = '/login';
        } else if (xhr.status === 400) {
            console.log(data);
        } else {
            console.log(data);
        }
    });
});

$('#eventAddModal').find('.delete').on('click', function() {
    let obj = $('#eventAddModal');
    let id = obj.find('input[name="id"]').val();

    obj.find('form').attr('action', '/event/delete/' + id);
    obj.find('form').submit();
});