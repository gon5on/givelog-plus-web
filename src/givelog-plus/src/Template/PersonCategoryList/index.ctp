<?php $this->assign('page_title', $page_title) ?>

<div class="row justify-content-md-center">
<div class="col-xl-6 col-lg-6 col-md-9">

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personCategoryAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物カテゴリ追加</a>
</div>

<div class="table-responsive table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;家族</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;親戚</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;友達</td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;会社</td>
</tr>

</tbody>
</table>
</div>
 
</div>
</div>

<?= $this->element('person_category_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e){
    $('#personCategoryAddModal').modal('show')
});
<?= $this->Html->scriptEnd() ?>