<!-- person category add modal -->
<div class="modal fade" id="personCategoryAddModal" tabindex="-1" role="dialog" aria-hidden="true">
<?= $this->AppForm->create(null) ?>
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

<?= $this->AppForm->control('id', ['type' => 'hidden']) ?>

</div>
<div class="modal-footer">
<button class="btn btn-danger delete" type="button" data-toggle="modal" data-target="#deleteConfirmModal" style="display:none">削除</button>
<?= $this->AppForm->button('保存', ['type' => 'button', 'class' => 'btn btn-primary save']) ?>
</div>
</div>
</div>
<?= $this->AppForm->end(); ?>
</div>

<?= $this->element('delete_confirm_modal', ['id' => '', 'message' => '<br><br>削除すると、人物に紐づいているこのカテゴリは空になります']) ?>

<?= $this->Html->script('person_category_add', ['block' => true]) ?>
<!-- person category add modal -->