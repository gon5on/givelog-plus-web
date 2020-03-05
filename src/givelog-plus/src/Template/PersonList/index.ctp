<?php $this->assign('page_title', $page_title) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物追加</a>
</div>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td><span>母</span>&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td><span>太郎くん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td><span>山田花子さん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td><span>田中一郎さん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">会社</span></td>
</tr>

<tr>
<td><span>佐藤陽子さん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td><span>田中はるかさん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td><span>父</span>&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td><span>おじいちゃん</span>&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td><span>おばあちゃん</span>&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td><span>三郎おじさん</span>&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td><span>山本社長</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">会社</span></td>
</tr>

<tr>
<td><span>田中副社長</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">会社</span></td>
</tr>

<tr>
<td><span>佐藤陽子さん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td><span>田中はるかさん</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

</tbody>
</table>
</div>

<?= $this->element('person_add_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    window.location.href = "<?= $this->Url->build(['action' => 'view']) ?>";
});
<?= $this->Html->scriptEnd() ?>