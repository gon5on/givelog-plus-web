$('#personCategoryAddModal').find('.save').on('click', function() {
    let obj = $('#personCategoryAddModal');
    let documentId = obj.find('input[name="document_id"]').val();

    let url;
    if (documentId) {
        url = '/person-category/edit/' + documentId;
    } else {
        url = '/person-category/add';
    }

    $.ajax({
        url: url,
        type: 'POST',
        data:{
            'name': obj.find('input[name="name"]').val(),
            'label_color': "#999999",       //TODO
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader("X-CSRF-Token", obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        location.href = '/person-category';
        obj.modal('hide');
        console.log(data);
    })
    .fail(function(data) {
        obj.modal('hide');
        console.log(data);
    });
});

$('#personCategoryAddModal').find('.delete').on('click', function() {
    let obj = $('#personCategoryAddModal');
    let documentId = obj.find('input[name="document_id"]').val();

    obj.find('form').attr('action', '/person-category/delete/' + documentId);
    obj.find('form').submit();
});