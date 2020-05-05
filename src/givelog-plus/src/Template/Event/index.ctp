<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small" id="add"><i class="fas fa-fw fa-plus-circle"></i>イベント追加</a>
</div>

<?php if ($events): ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($events as $event): ?>
<?= $this->element('event_table_tr', ['event' => $event]) ?>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<?= $this->element('event_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->script('event_list', ['block' => true]) ?>