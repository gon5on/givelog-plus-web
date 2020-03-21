<!-- account change modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-hidden="true">
<?= $this->AppForm->create(null) ?>
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">メールアドレス/パスワード変更</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<div class="label-area">
<i class="fas fa-fw fa-envelope"></i><span class="text-xs font-weight-bold">メールアドレス</span>
</div>
<?= $this->AppForm->control('email', ['label' => false, 'class' => 'form-control', 'placeholder' => 'user@givelog.com', 'value' => $email]) ?>

<div class="label-area">
<i class="fas fa-fw fa-key"></i><span class="text-xs font-weight-bold">パスワード</span>
</div>
<?= $this->AppForm->control('password', ['label' => false, 'class' => 'form-control', 'placeholder' => '********']) ?>

<div class="label-area">
<i class="fas fa-fw fa-key"></i><span class="text-xs font-weight-bold">確認用パスワード</span>
</div>
<?= $this->AppForm->control('password_confirm', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => '********']) ?>

</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
<?= $this->AppForm->button('保存', ['type' => 'button', 'class' => 'btn btn-primary save']) ?>
</div>
</div>
</div>
<?= $this->AppForm->end(); ?>
</div>


<?= $this->Html->script('user-edit', ['block' => true]) ?>
<!-- account change modal -->
