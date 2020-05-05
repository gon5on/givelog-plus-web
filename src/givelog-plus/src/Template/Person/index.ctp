<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物追加</a>
</div>

<?php if ($persons): ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($persons as $categoryPersons): ?>
<?php foreach ($categoryPersons as $person): ?>
<?= $this->element('person_table_tr', ['person' => $person]) ?>
<?php endforeach; ?>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<?= $this->element('person_add_modal') ?>

<?= $this->Html->script('person_list', ['block' => true]) ?>