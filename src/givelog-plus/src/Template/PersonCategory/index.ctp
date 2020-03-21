<?php $this->assign('page_title', $page_title) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small" id="add"><i class="fas fa-fw fa-plus-circle"></i>人物カテゴリ追加</a>
</div>

<?php if ($personCategories): ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($personCategories as $personCategory): ?>
<tr data-id="<?= $personCategory->id ?>" data-name="<?= $personCategory->name ?>">
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span><?= $personCategory->name ?></span></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<?= $this->element('person_category_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
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
<?= $this->Html->scriptEnd() ?>