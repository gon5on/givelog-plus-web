<!-- delete confirm modal-->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-body">
本当に削除しますか？<br>
削除すると元に戻すことはできません。
</div>

<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
<?= $this->Form->postLink('削除', ['controller' => 'Withdraw'], ['class' => 'btn btn-danger']) ?>
</div>
</div>
</div>
</div>
<!-- delete confirm modal-->