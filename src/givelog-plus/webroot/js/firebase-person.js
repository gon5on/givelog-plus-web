$('#personAddModal').find('.save').on('click', function() {
    let obj = $('#personAddModal');
    let documentId = obj.find('input[name="document_id"]').val();

    let url;
    if (documentId) {
        url = '/person/edit/' + documentId;
    } else {
        url = '/person/add';
    }

    $.ajax({
        url: url,
        type: 'POST',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'person_category_id': '06927b8ffcd74602b301',       //TODO
            'memo': obj.find('textarea[name="memo"]').val(),
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        location.href = '/person';
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
    let documentId = obj.find('input[name="document_id"]').val();

    obj.find('form').attr('action', '/person/delete/' + documentId);
    obj.find('form').submit();
});