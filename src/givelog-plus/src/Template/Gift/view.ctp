<?php $this->assign('page_title', $page_title) ?>

<div class="text-right">
<a class="small" href="<?= $this->Url->build(['controller' => 'gift', 'action' => 'edit', $gift->id]) ?>"><i class="fas fa-fw fa-edit"></i>編集</a>
&nbsp;&nbsp;
<a href="javascript::void(0)" class="small" id="deleteBtn"><i class="fas fa-fw fa-trash"></i>削除</a>
</div>

<hr>

<div class="label-area">
<i class="fas fa-fw fa-calendar-day"></i><span class="text-xs font-weight-bold">
日付</span>
</div>
<span><?= date('Y/m/d', strtotime($gift->date)) ?></span>
<?php if ($gift->event): ?>
&nbsp;&nbsp;<?= $this->App->badge($gift->event->labelColor, $gift->event->name); ?>
<?php endif; ?>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-user"></i><span class="text-xs font-weight-bold"></span>
</div>
<span>
<?= $this->App->giftFromTo($gift); ?>
</span>
&nbsp;&nbsp;<?= $this->App->giftPersonCategoryLabel($gift); ?>
<hr>

<div class="label-area">
<i class="fas fa-fw fa-gift"></i><span class="text-xs font-weight-bold">プレゼント</span>
</div>
<span><?= $gift->gift ?></span>
<hr>

<?php if ($gift->price): ?>
<div class="label-area">
<i class="fas fa-fw fa-dollar-sign"></i><span class="text-xs font-weight-bold">金額</span>
</div>
<span><?= $gift->price ?></span>
<hr>
<?php endif; ?>

<?php if ($gift->url): ?>
<div class="label-area">
<i class="fas fa-fw fa-window-restore"></i><span class="text-xs font-weight-bold">URL</span>
</div>
<?= $this->Html->link($gift->url, $gift->url, ['target' => 'blank']) ?>
<hr>
<?php endif; ?>

<div class="label-area">
<i class="fas fa-fw fa-image"></i><span class="text-xs font-weight-bold">画像</span>
</div>
<img src="https://asset.recipe-blog.jp/cache/images/item/bb/66/98fca5ab1240e98b15d45ab368231ea94e59bb66.400x0.none.jpg">
<hr>

<?php if ($gift->memo): ?>
<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>
<span><?= nl2br($gift->memo) ?></span>
<hr>
<?php endif; ?>

<div class="text-center mb-4">
<?= $this->Html->link('< 戻る', ['controller' => 'Gift', 'action' => 'index'], ['class' => 'small']) ?>
</div>


<?= $this->element('delete_confirm_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$('#deleteBtn').on('click', function(e) {
    let obj = $('#deleteConfirmModal');

    obj.find('form').attr('action', '/gift/delete/<?= $gift->id ?>');
    obj.modal('show');
});
<?= $this->Html->scriptEnd() ?>