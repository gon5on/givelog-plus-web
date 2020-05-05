$('#userEditModal').find('.save').on('click', function() {
    let obj = $('#userEditModal');

    $.ajax({
        url: '/user/edit/',
        type: 'POST',
        data:{
            'email': obj.find('input[name="email"]').val(),
            'password': obj.find('input[name="password"]').val(),
            'passwordConfirm': obj.find('input[name="passwordConfirm"]').val(),
        },
        beforeSend: function(xhr){
            xhr.setRequestHeader('X-CSRF-Token', obj.find('input[name="_csrfToken"]').val());
        },
    })
    .done(function(data) {
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