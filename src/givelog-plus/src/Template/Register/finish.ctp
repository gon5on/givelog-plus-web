<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">アカウント新規作成</h1>
</div>

<p class="mb-4">ご登録ありがとうございました！</p>

<a href="javascript:void(0)" id="start" class="btn btn-primary btn-user btn-block mb-4">さっそくを使ってみる</a>

<hr>

<div class="text-center">
<?= $this->Html->link('< 戻る', ['controller' => 'Login'], ['class' => 'small']) ?>
</div>

<?= $this->element('hidden_login'); ?>