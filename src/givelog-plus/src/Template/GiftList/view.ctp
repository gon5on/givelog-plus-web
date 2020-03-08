<?php $this->assign('page_title', $page_title) ?>

<div class="text-right">
<a class="small" href="<?= $this->Url->build(['controller' => 'gift-edit']) ?>"><i class="fas fa-fw fa-edit"></i>編集</a>
&nbsp;&nbsp;
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-fw fa-trash"></i>削除</a>
</div>

<hr>

<div class="label-area">
<i class="fas fa-fw fa-calendar-day"></i><span class="text-xs font-weight-bold">
日付</span>
</div>
<span>2020/01/23</span>
&nbsp;&nbsp;<span class="badge badge-pill badge-info">母の日</span>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-user"></i><span class="text-xs font-weight-bold">だれからだれへ</span>
</div>
<span><?= $this->Html->link('自分', ['controller' => 'PersonList', 'action' => 'view']) ?> から 
<?= $this->Html->link('母', ['controller' => 'PersonList', 'action' => 'view']) ?> へ</span>
&nbsp;&nbsp;<span class="badge badge-pill badge-danger">家族</span>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-gift"></i><span class="text-xs font-weight-bold">プレゼント</span>
</div>
<span>カーネーションの花束と抹茶ケーキ</span>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-dollar-sign"></i><span class="text-xs font-weight-bold">金額</span>
</div>
<span>5,580円</span>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-window-restore"></i><span class="text-xs font-weight-bold">URL</span>
</div>
<?= $this->Html->link('https://gift.com/figt-for-you', 'https://gift.com/figt-for-you', ['target' => 'blank']) ?>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-image"></i><span class="text-xs font-weight-bold">画像</span>
</div>
<img src="https://asset.recipe-blog.jp/cache/images/item/bb/66/98fca5ab1240e98b15d45ab368231ea94e59bb66.400x0.none.jpg">
<hr>

<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>
<span>以前母と京都に旅行にいったときお土産で買った抹茶がおいしかったので、そのお店の抹茶ケーキをお取り寄せした。</span>
<hr>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'GiftList', 'action' => 'index'], ['class' => 'small']) ?>
</div>


<?= $this->element('delete_confirm_modal') ?>