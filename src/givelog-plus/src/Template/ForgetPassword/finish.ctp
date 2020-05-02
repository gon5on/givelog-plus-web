<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">パスワード再発行</h1>
</div>

<p class="mb-2">入力されたメールアドレス宛てに新しいパスワードが書かれたメールをお送りしました。</p>
<p class="mb-4">メールが届かない場合は、メールアドレスが間違っていたり、迷惑メールフォルダに入っている可能性があります。</p>

<hr>

<div class="text-center">
<?= $this->Html->link('< 戻る', ['controller' => 'Login'], ['class' => 'small']) ?>
</div>
