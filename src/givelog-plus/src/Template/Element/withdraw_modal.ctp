<!-- withdraw modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">退会</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<p>退会してよろしいですか？</p>
<p class="text-danger">退会するとすべてのデータが削除されます、データは復活できません。</br>
よろしければ、削除ボタンを押してください。</p>
</div>

<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
<?= $this->Form->postLink('退会', ['controller' => 'Withdraw'], ['class' => 'btn btn-danger']) ?>
</div>
</div>
</div>
</div>
<!-- withdraw modal -->