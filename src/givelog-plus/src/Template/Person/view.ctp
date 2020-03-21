<?php $this->assign('page_title', $person->name) ?>
<?php if ($person->personCategory): ?>
<?php $this->assign('person_category_label', '&nbsp;&nbsp;<span class="badge badge-pill badge-danger badge-font-size">' . $person->personCategory->name . '</span>') ?>
<?php endif; ?>

<div class="text-right">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-edit"></i>編集</a>
&nbsp;&nbsp;
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-fw fa-trash"></i>削除</a>
</div>

<hr>

<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>

<p><?= nl2br($person->memo) ?></p>

<hr>

<div class="label-area mb-2">
<i class="fas fa-fw fa-gift"></i><span class="text-xs font-weight-bold">プレゼント</span>
</div>

<div class="table table-hover">
<table class="table person-gift-table" id="dataTable" width="100%" cellspacing="0">
<tbody>

<tr>
<td>
<span>2019/01/20</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">誕生日</span><br>
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> と
<?= $this->Html->link('山田はなこちゃん', ['action' => 'view']) ?> から
<?= $this->Html->link('自分', ['action' => 'view']) ?> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<?= $this->Html->link('自分', ['action' => 'view']) ?> から
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> へ チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<?= $this->Html->link('自分', ['action' => 'view']) ?> から
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> へ 文房具セット
</td>
</tr>

<tr>
<td>
<span>2019/01/20</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">誕生日</span><br>
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> と
<?= $this->Html->link('山田はなこちゃん', ['action' => 'view']) ?> から
<?= $this->Html->link('自分', ['action' => 'view']) ?> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<?= $this->Html->link('自分', ['action' => 'view']) ?> から
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> へ チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<?= $this->Html->link('自分', ['action' => 'view']) ?> から
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> へ 文房具セット
</td>
</tr>

<tr>
<td>
<span>2019/01/20</span>&nbsp;&nbsp;<span class="badge badge-pill badge-primary">誕生日</span><br>
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> と
<?= $this->Html->link('山田はなこちゃん', ['action' => 'view']) ?> から
<?= $this->Html->link('自分', ['action' => 'view']) ?> へ 手作りクッキー
</td>
</tr>

<tr>
<td>
<span>2019/02/14</span>&nbsp;&nbsp;<span class="badge badge-pill badge-warning">バレンタインデー</span><br>
<?= $this->Html->link('自分', ['action' => 'view']) ?> から
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> へ チロルチョコ詰め合わせ
</td>
</tr>

<tr>
<td>
<span>2016/04/10</span>&nbsp;&nbsp;<span class="badge badge-pill badge-info">入学祝い</span><br>
<?= $this->Html->link('自分', ['action' => 'view']) ?> から
<?= $this->Html->link('山田太郎くん', ['action' => 'view']) ?> へ 文房具セット
</td>
</tr>

</tbody>
</table>
</div>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'Person', 'action' => 'index'], ['class' => 'small']) ?>
</div>


<?= $this->element('person_add_modal') ?>

<?= $this->element('delete_confirm_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    window.location.href = "<?= $this->Url->build(['controller' => 'GiftList', 'action' => 'view']) ?>";
});
<?= $this->Html->scriptEnd() ?>