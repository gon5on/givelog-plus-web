<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-body">
ログアウトしますか？
</div>

<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
<?= $this->Form->postLink('ログアウト', ['controller' => 'Logout'], ['class' => 'btn btn-primary']) ?>
</div>
</div>
</div>
</div>
<!-- Logout Modal-->
