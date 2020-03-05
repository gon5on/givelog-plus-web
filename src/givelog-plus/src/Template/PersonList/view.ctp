<?php $this->assign('page_title', $page_title) ?>
<?php $this->assign('person_category_label', '&nbsp;&nbsp;<span class="badge badge-pill badge-info badge-font-size">親戚</span>') ?>

<div class="text-right">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-edit"></i>編集</a>
&nbsp;&nbsp;
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-fw fa-trash"></i>削除</a>
</div>

<hr>

<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>

<p>兄の長男（甥っ子）<br>
2010/3/12 生まれ<br>
車が好き、卵アレルギーがあるので食べ物をあげるときは注意</p>

<hr>

<div class="label-area mb-2">
<i class="fas fa-fw fa-gift"></i><span class="text-xs font-weight-bold">プレゼント</span>
</div>

<div class="table table-hover">
<table class="table person-gift-table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td>
<span>2019/03/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">ホワイトデー</span><br>
<a href="">渡辺まりちゃん</a> と <a href="">自分</a> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<a href="">自分</a> から チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<a href="">自分</a> から 文房具セット
</td>
</tr>

<tr>
<td>
<span>2019/03/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">ホワイトデー</span><br>
<a href="">自分</a> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<a href="">自分</a> から チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<a href="">自分</a> から 文房具セット
</td>
</tr>

<tr>
<td>
<span>2019/03/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">ホワイトデー</span><br>
<a href="">自分</a> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<a href="">自分</a> から チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<a href="">自分</a> から 文房具セット
</td>
</tr>


<tr>
<td>
<span>2019/03/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">ホワイトデー</span><br>
<a href="">自分</a> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<a href="">自分</a> から チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<a href="">自分</a> から 文房具セット
</td>
</tr>

</tbody>
</table>
</div>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'PersonList'], ['class' => 'small']) ?>
</div>


<?= $this->element('person_add_modal') ?>

<?= $this->element('delete_confirm_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    window.location.href = "<?= $this->Url->build(['controller' => 'GiftList', 'action' => 'view']) ?>";
});
<?= $this->Html->scriptEnd() ?>