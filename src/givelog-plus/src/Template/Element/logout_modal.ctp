<!-- Logout Modal-->
<?= $this->Html->script('https://www.gstatic.com/firebasejs/7.10.0/firebase-auth.js', ['block' => true]) ?>
<?= $this->Html->script('firebase-logout.js', ['block' => true]) ?>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-body">
ログアウトしますか？
</div>

<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
<?= $this->AppForm->button('ログアウト', ['class' => 'btn btn-primary', 'id' => 'logout']) ?>
</div>
</div>
</div>
</div>
<!-- Logout Modal-->
