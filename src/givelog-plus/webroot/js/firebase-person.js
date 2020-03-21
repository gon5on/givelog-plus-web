$('#personAddModal').find('.save').on('click', function() {
    let obj = $('#personAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: (id) ?  '/person/edit/' + id : '/person/add',
        type: 'POST',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'person_category_id': 'd1ccbc6e24a440d4aae7',       //TODO
            'memo': obj.find('textarea[name="memo"]').val(),
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        location.href = (id) ? '/person/view/' + id : '/person';
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

$('#personAddModal').find('.delete').on('click', function() {
    let obj = $('#personAddModal');
    let id = obj.find('input[name="id"]').val();

    obj.find('form').attr('action', '/person/delete/' + id);
    obj.find('form').submit();
});