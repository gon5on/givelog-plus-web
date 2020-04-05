<?php $this->assign('page_title', $page_title) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物追加</a>
</div>

<?php if ($persons): ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($persons as $person): ?>
<tr data-id="<?= $person->id ?>">
<td>
<span><?= $person->name ?></span>&nbsp;&nbsp;
<?php if ($person->personCategory): ?>
<?= $this->App->badge($person->personCategory->labelColor, $person->personCategory->name); ?>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<?= $this->element('person_add_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    window.location.href = "<?= $this->Url->build(['action' => 'view']) ?>/" + $(this).data('id');
});
<?= $this->Html->scriptEnd() ?>