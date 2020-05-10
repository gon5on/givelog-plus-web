<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">パスワード再発行</h1>
</div>

<p class="mb-4">メールアドレスを入力して送信ボタンを押してください。<br>
パスワード再発行用のメールをお送りします。</p>

<?= $this->AppForm->create(null, ['class' => 'user']) ?>

<?= $this->AppForm->control('email', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => 'メールアドレス']) ?>

<?= $this->AppForm->button('送信', ['class' => 'btn btn-primary btn-user btn-block mb-4']) ?>
<?= $this->AppForm->end(); ?>

<hr>

<div class="text-center">
<?= $this->Html->link('< 戻る', ['controller' => 'Login'], ['class' => 'small']) ?>
</div>
