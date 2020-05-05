<!-- person add modal -->
<?php
use App\Model\Entity\Person;

if (!isset($person)) {
    $person = new Person();
}
extract($person->toArrayWithDefaultKey());
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
<?= $this->AppForm->control('name', ['id' => 'personName', 'label' => false, 'class' => 'form-control', 'placeholder' => '山田太郎くん', 'value' => $name]) ?>

<div class="label-area">
<i class="fas fa-fw fa-folder-open"></i><span class="text-xs font-weight-bold">カテゴリ</span>
</div>
<?= $this->AppForm->control('personCategoryId', ['label' => false, 'empty' => '選んでください', 'class' => 'custom-select"', 'options' => $personCategories, 'value' => $personCategoryId]) ?>

<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>
<?= $this->AppForm->control('memo', ['id' => 'personMemo', 'label' => false, 'type' => 'textarea', 'class' => 'form-control', 'rows'=> 5, 'value' => $memo]) ?>

<?= $this->AppForm->control('id', ['id' => 'personId', 'type' => 'hidden', 'value' => $id]) ?>

</div>
<div class="modal-footer">
<?= $this->AppForm->button('保存', ['type' => 'button', 'class' => 'btn btn-primary save']) ?>
</div>
</div>
</div>
<?= $this->AppForm->end(); ?>
</div>

<?= $this->Html->script('person_add', ['block' => true]) ?>
<!-- person add modal -->