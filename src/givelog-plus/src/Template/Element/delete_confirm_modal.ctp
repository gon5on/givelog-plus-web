<!-- delete confirm modal-->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-body">
削除しますか？<br>
削除すると元に戻すことはできません。
<?php 
if (!empty($message)) {
    echo nl2br($message);
}
?>
</div>

<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
<?= $this->AppForm->postLink('削除', ['action' => 'delete', $id], ['type' => 'button', 'class' => 'btn btn-danger delete']) ?>
</div>
</div>
</div>
</div>
<!-- delete confirm modal-->