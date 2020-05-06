<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach($informations as $information): ?>
<tr data-id="<?= $information->id ?>">
<td>
<span><?= date('Y/m/d', strtotime($information->date)) ?></span>&nbsp;&nbsp;
<span class="badge badge-pill badge-warning"><?= $information->type ?></span><br>
<span><?= $information->title ?></span>

<?= $this->element('infomation_modal', ['information' => $information]) ?>

</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'Setting'], ['class' => 'small']) ?>
</div>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    $("#informationModal_" + $(this).data('id')).modal('show');
});
<?= $this->Html->scriptEnd() ?>