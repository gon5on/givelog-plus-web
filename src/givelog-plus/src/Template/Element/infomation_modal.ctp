<!-- information modal -->
<div class="modal fade" id="informationModal_<?= $information->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">
<div class="small">
<span><?= date('Y/m/d', strtotime($information->date)) ?></span>&nbsp;&nbsp;
<span class="badge badge-pill badge-warning"><?= $information->type ?></span>
</div>
<?= $information->title ?>
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<?= $information->body ?>
</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">閉じる</button>
</div>
</div>
</div>
</div>
<!-- information modal -->
