<?php $this->assign('page_title', $page_title) ?>

<div class="text-right mb-2">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personCategoryAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物カテゴリ追加</a>
</div>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td><span class="badge badge-pill badge-danger">&nbsp;</span>&nbsp;&nbsp;<span>家族</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-warning">&nbsp;</span>&nbsp;&nbsp;<span>親戚</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-info">&nbsp;</span>&nbsp;&nbsp;<span>友達</span></td>
</tr>

<tr>
<td><span class="badge badge-pill badge-primary">&nbsp;</span>&nbsp;&nbsp;<span>会社</span></td>
</tr>

</tbody>
</table>
</div>


<?= $this->element('person_category_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e){
    $('#personCategoryAddModal').modal('show')
});
<?= $this->Html->scriptEnd() ?>