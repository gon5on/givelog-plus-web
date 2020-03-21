<!-- person add modal -->
<?php
$id = (isset($person)) ? $person->id : '';
$name = (isset($person)) ? $person->name : '';
$memo = (isset($person)) ? $person->memo : '';
?>

<div class="modal fade" id="personAddModal" tabindex="-1" role="dialog" aria-hidden="true">
<?= $this->AppForm->create(null) ?>
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">人物</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div class="label-area">
<i class="fas fa-fw fa-user"></i><span class="text-xs font-weight-bold">名前</span>
</div>
<?= $this->AppForm->control('name', ['label' => false, 'class' => 'form-control', 'placeholder' => '山田太郎くん', 'value' => $name]) ?>

<div class="label-area">
<i class="fas fa-fw fa-folder-open"></i><span class="text-xs font-weight-bold">カテゴリ</span>
</div>
<?= $this->AppForm->control('person_category_id', ['label' => false, 'empty' => '選んでください', 'class' => 'custom-select"', 'options' => ['家族', '友達', '会社', '親戚']]) ?>

<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>
<?= $this->AppForm->control('memo', ['label' => false, 'type' => 'textarea', 'class' => 'form-control', 'rows'=> 5, 'value' => $memo]) ?>

<?= $this->AppForm->control('id', ['type' => 'hidden', 'value' => $id]) ?>

</div>
<div class="modal-footer">
<?php if (isset($person)): ?>
<?= $this->AppForm->button('削除', ['type' => 'button', 'class' => 'btn btn-danger delete']) ?>&nbsp;
<?php endif; ?>
<?= $this->AppForm->button('保存', ['type' => 'button', 'class' => 'btn btn-primary save']) ?>
</div>
</div>
</div>
<?= $this->AppForm->end(); ?>
</div>

<?= $this->Html->script('firebase-person', ['block' => true]) ?>
<!-- person add modal -->