<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small" id="add"><i class="fas fa-fw fa-plus-circle"></i>人物カテゴリ追加</a>
</div>

<?php if ($personCategories): ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<?php foreach ($personCategories as $personCategory): ?>
<?= $this->element('person_category_table_tr', ['personCategory' => $personCategory]) ?>
<?php endforeach; ?>

</tbody>
</table>
</div>

<?php endif; ?>

<?= $this->element('person_category_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->script('person_category_list', ['block' => true]) ?>