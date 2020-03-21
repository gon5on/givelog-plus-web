<?php $this->assign('page_title', $page_title) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small" id="add"><i class="fas fa-fw fa-plus-circle"></i>イベント追加</a>
</div>

<?php if ($events): ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($events as $event): ?>
<tr data-id="<?= $event->id ?>" data-name="<?= $event->name ?>">
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span><?= $event->name ?></span></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<?= $this->element('event_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$('#add').on('click', function(e) {
    let obj = $('#eventAddModal');

    obj.find('.delete').hide();
    obj.find('input[name="name"]').val('');
    obj.find('input[name="id"]').val('');
    obj.modal('show');
});

$('tbody tr').on('click', function(e) {
    let obj = $('#eventAddModal');

    obj.find('.delete').show();
    obj.find('input[name="name"]').val($(this).data('name'));
    obj.find('input[name="id"]').val($(this).data('id'));
    obj.modal('show');
});
<?= $this->Html->scriptEnd() ?>