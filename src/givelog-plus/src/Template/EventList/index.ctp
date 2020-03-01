<?php $this->assign('page_title', $page_title) ?>

<div class="row justify-content-md-center">
<div class="col-xl-6 col-lg-6 col-md-9">

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#eventAddModal"><i class="fas fa-fw fa-plus-circle"></i>イベント追加</a>
</div>

<div class="table-responsive table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;誕生日</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;結婚祝い</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;出産祝い</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;新築祝い</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;お歳暮</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;お中元</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;母の日</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;父の日</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;こどもの日</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;敬老の日</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;バレンタイン</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;クリスマス</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;入学祝い</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;卒業祝い</td>
</tr>

</tbody>
</table>
</div>
 
</div>
</div>

<?= $this->element('event_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e){
    $('#eventAddModal').modal('show')
});
<?= $this->Html->scriptEnd() ?>