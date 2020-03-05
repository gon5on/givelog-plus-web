<?php $this->assign('page_title', $page_title) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#eventAddModal"><i class="fas fa-fw fa-plus-circle"></i>イベント追加</a>
</div>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span>誕生日</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;<span>結婚祝い</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;<span>出産祝い</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;<span>新築祝い</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span>お歳暮</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;<span>お中元</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;<span>母の日</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;<span>父の日</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span>こどもの日</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;<span>敬老の日</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;<span>バレンタイン</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;<span>クリスマス</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span>入学祝い</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;<span>卒業祝い</span></td>
</tr>

</tbody>
</table>
</div>

<?= $this->element('event_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    $('#eventAddModal').modal('show')
});
<?= $this->Html->scriptEnd() ?>