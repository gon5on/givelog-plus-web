<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td>
<span>2020/5/12</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">メンテナンス</span><br>
<span>定期メンテナンスのお知らせ</span>
</td>
</tr>

<tr>
<td>
<span>2020/5/12</span>&nbsp;&nbsp;<span class="badge badge-pill badge-success">お知らせ</span><br>
<span>新機能リリースのお知らせ</span>
</td>
</tr>

<tr>
<td>
<span>2020/5/12</span>&nbsp;&nbsp;<span class="badge badge-pill badge-danger">重要</span><br>
<span>不具合のお詫び</span>
</td>
</tr>

<tr>
<td>
<span>2020/5/12</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">メンテナンス</span><br>
<span>定期メンテナンスのお知らせ</span>
</td>
</tr>

</tbody>
</table>
</div>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'Setting'], ['class' => 'small']) ?>
</div>

<?= $this->element('infomation_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    $("#informationModal").modal('show');
});
<?= $this->Html->scriptEnd() ?>