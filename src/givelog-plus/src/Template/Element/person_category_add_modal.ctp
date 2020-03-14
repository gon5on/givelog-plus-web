<!-- person category add modal -->
<?= $this->AppForm->create(null, ['url' => ['controller' => 'PersonCategoryAdd']]) ?>
<div class="modal fade" id="personCategoryAddModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">人物カテゴリ</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div class="label-area">
<i class="fas fa-fw fa-folder-open"></i><span class="text-xs font-weight-bold">人物カテゴリ</span>
</div>
<?= $this->AppForm->control('name', ['label' => false, 'class' => 'form-control', 'placeholder' => '家族']) ?>

<div class="label-area">
<i class="fas fa-fw fa-palette"></i><span class="text-xs font-weight-bold">ラベルカラー</span>
</div>
<div id="hslflat"></div>

</div>
<div class="modal-footer">
<?= $this->AppForm->button('削除', ['class' => 'btn btn-danger']) ?>&nbsp;
<?= $this->AppForm->button('保存', ['class' => 'btn btn-primary']) ?>
</div>
</div>
</div>
</div>
<?= $this->AppForm->end(); ?>
<!-- person category add modal -->