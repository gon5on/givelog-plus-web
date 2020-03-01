<?php $this->assign('page_title', $page_title) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">givelog plus</h1>
</div>

<?= $this->AppForm->create(null, ['class' => 'user']) ?>

<?= $this->AppForm->control('email', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => 'メールアドレス']) ?>

<?= $this->AppForm->control('password', ['label' => false, 'class' => 'form-control form-control-user mb-4', 'placeholder' => 'パスワード']) ?>

<?= $this->AppForm->button('ログイン', ['class' => 'btn btn-primary btn-user btn-block']) ?>
<?= $this->AppForm->end(); ?>
<hr>

<?= $this->Html->link('アカウント新規作成', ['controller' => 'Register'], ['class' => 'btn btn-info btn-user btn-block']) ?>
<hr>

<div class="text-center">
<?= $this->Html->link('> パスワードを忘れた方はこちら', ['controller' => 'ForgetPassword'], ['class' => 'small']) ?>
</div>
