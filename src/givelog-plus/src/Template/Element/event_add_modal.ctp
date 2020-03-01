<!-- event add modal -->
<?= $this->AppForm->create(null) ?>
<div class="modal fade" id="eventAddModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">イベント</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div class="label-area">
<i class="fas fa-fw fa-calendar-check"></i><span class="text-xs font-weight-bold">イベント</span>
</div>
<?= $this->AppForm->control('event_name', ['label' => false, 'class' => 'form-control', 'placeholder' => '誕生日']) ?>

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
<!-- event add modal -->