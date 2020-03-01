<?php $this->assign('page_title', $page_title) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">アカウント新規作成</h1>
</div>

<p class="mb-2">ご登録ありがとうございました！</p>
<p class="mb-4">メールアドレスに登録完了メールをお送りしました。</p>

<?= $this->Html->link('さっそくを使ってみる', ['controller' => 'GiftList'], ['class' => 'btn btn-primary btn-user btn-block mb-4']) ?>

<hr>

<div class="text-center">
<?= $this->Html->link('< 戻る', ['controller' => 'Login'], ['class' => 'small']) ?>
</div>
