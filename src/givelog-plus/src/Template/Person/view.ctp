<?php $this->assign('pageTitle', $person->name) ?>
<?php if ($person->personCategory): ?>
<?php $this->assign('personCategoryLabel', '&nbsp;&nbsp;<span class="badge badge-pill badge-font-size" style="background-color:' . $person->personCategory->labelColor . '">' . $person->personCategory->name . '</span>') ?>
<?php endif; ?>

<div class="text-right">
<a href="javascript::void(0)" class="small" data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-edit"></i>編集</a>
&nbsp;&nbsp;
<?php if ($person->gifts): ?>
<a href="javascript::void(0)" class="small" data-toggle="modal" data-target="#cantDeletePersonModal"><i class="fas fa-fw fa-trash"></i>削除</a>
<?php else: ?>
<a href="javascript::void(0)" class="small" data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-fw fa-trash"></i>削除</a>
<?php endif; ?>
</div>

<hr>

<?php if ($person->memo): ?>
<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>

<p><?= nl2br($person->memo) ?></p>

<hr>
<?php endif; ?>

<div class="label-area mb-2">
<i class="fas fa-fw fa-gift"></i><span class="text-xs font-weight-bold">プレゼント</span>
</div>

<?php if ($person->gifts): ?>

<div class="table table-hover">
<table class="table person-gift-table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($person->gifts as $gift): ?>

<tr data-id="<?= $gift->id ?>">
<td>
<span><?= date('Y/m/d', strtotime($gift->date)) ?></span>
<?php if ($gift->event): ?>
&nbsp;&nbsp;
<?= $this->App->badge($gift->event->labelColor, $gift->event->name); ?>
<?php endif; ?>
<?= $this->App->giftPersonCategoryLabel($gift); ?>
<br>
<?= $this->App->giftFromTo($gift); ?> <?= $gift->gift ?>
</td>
</tr>

<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'Person', 'action' => 'index'], ['class' => 'small']) ?>
</div>


<?= $this->element('person_add_modal') ?>

<?= $this->element('delete_confirm_modal', ['id' => $person->id]) ?>

<?= $this->element('cant_delete_person_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    let id = $(this).data('id');
    window.location.href = "<?= $this->Url->build(['controller' => 'Gift', 'action' => 'view', ]) ?>/" + id;
});
<?= $this->Html->scriptEnd() ?>