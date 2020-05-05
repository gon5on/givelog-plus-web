$('#add').on('click', function(e) {
    let obj = $('#personCategoryAddModal');

    obj.find('.delete').hide();
    obj.find('input[name="name"]').val('');
    obj.find('input[name="id"]').val('');
    obj.modal('show');
});

$('tbody tr').on('click', function(e) {
    let obj = $('#personCategoryAddModal');

    obj.find('.delete').show();
    obj.find('input[name="name"]').val($(this).data('name'));
    obj.find('input[name="id"]').val($(this).data('id'));
    obj.modal('show');
});