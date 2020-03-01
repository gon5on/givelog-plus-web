<?php $this->assign('page_title', $page_title) ?>

<div class="row justify-content-md-center">
<div class="col-xl-6 col-lg-6 col-md-9">

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物追加</a>
</div>

<div class="table-responsive table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td>母&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td>太郎くん&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td>山田花子さん&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td>田中一郎さん&nbsp;&nbsp;<span class="badge badge-pill badge-primary">会社</span></td>
</tr>

<tr>
<td>佐藤陽子さん&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td>田中はるかさん&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td>父&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td>おじいちゃん&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td>おばあちゃん&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td>三郎おじさん&nbsp;<span class="badge badge-pill badge-danger">家族</span></td>
</tr>

<tr>
<td>山本社長&nbsp;&nbsp;<span class="badge badge-pill badge-primary">会社</span></td>
</tr>

<tr>
<td>田中副社長&nbsp;&nbsp;<span class="badge badge-pill badge-primary">会社</span></td>
</tr>

<tr>
<td>佐藤陽子さん&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

<tr>
<td>田中はるかさん&nbsp;&nbsp;<span class="badge badge-pill badge-info">友達</span></td>
</tr>

</tbody>
</table>
</div>
 
</div>
</div>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    window.location.href = "<?= $this->Url->build(['action' => 'view']) ?>";
});
<?= $this->Html->scriptEnd() ?>