$('#deleteConfirmModal').find('.delete').on('click', function() {
    let form =  $('form');

    $.ajax({
        url: '/gift/delete/' +  form.find('input[name="id"]').val(),
        type: 'POST',
        dataType: 'json',
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', form.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
        $('#deleteConfirmModal').modal('hide');

        location.href = '/gift';
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