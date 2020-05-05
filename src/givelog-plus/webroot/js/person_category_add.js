$('#personCategoryAddModal').find('.save').on('click', function() {
    let obj = $('#personCategoryAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: (id) ?  '/person-category/edit/' + id : '/person-category/add',
        type: 'POST',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'labelColor': '#999999',       //TODO
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        location.href = '/person-category';
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

$('#deleteConfirmModal').find('.delete').on('click', function() {
    let obj = $('#personCategoryAddModal');
    let id = obj.find('input[name="id"]').val();

    $.ajax({
        url: '/person-category/delete/' + id,
        type: 'POST',
        dataType: 'json',
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        $('#deleteConfirmModal').modal('hide');
        obj.modal('hide');

        location.href = '/person-category';
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