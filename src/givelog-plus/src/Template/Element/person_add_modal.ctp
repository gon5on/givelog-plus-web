<!-- person add modal -->
<?= $this->AppForm->create(null) ?>
<div class="modal fade" id="personAddModal" tabindex="-1" role="dialog" aria-hidden="true">
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
<?= $this->AppForm->control('person_name', ['label' => false, 'class' => 'form-control', 'placeholder' => '山田太郎くん']) ?>

<div class="label-area">
<i class="fas fa-fw fa-folder-open"></i><span class="text-xs font-weight-bold">カテゴリ</span>
</div>
<?= $this->AppForm->control('category', ['label' => false, 'empty' => '選んでください', 'class' => 'custom-select"', 'options' => ['家族', '友達', '会社', '親戚']]) ?>

<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>
<?= $this->AppForm->control('person_memo', ['label' => false, 'type' => 'textarea', 'class' => 'form-control', 'rows'=> 5]) ?>

</div>
<div class="modal-footer">
<?= $this->AppForm->button('保存', ['class' => 'btn btn-primary']) ?>
</div>
</div>
</div>
</div>
<?= $this->AppForm->end(); ?>
<!-- person add modal -->