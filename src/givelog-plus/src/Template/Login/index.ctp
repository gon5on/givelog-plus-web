<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">givelog plus</h1>
</div>

<div class="user">

<?= $this->AppForm->control('email', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => 'メールアドレス']) ?>

<?= $this->AppForm->control('password', ['label' => false, 'class' => 'form-control form-control-user mb-4', 'placeholder' => 'パスワード']) ?>

<?= $this->AppForm->button('ログイン', ['class' => 'btn btn-primary btn-user btn-block', 'id' => 'login']) ?>

</div>

<hr>

<?= $this->Html->link('アカウント新規作成', ['controller' => 'Register'], ['class' => 'btn btn-info btn-user btn-block']) ?>
<hr>

<div class="text-center">
<?= $this->Html->link('> パスワードを忘れた方はこちら', ['controller' => 'ForgetPassword'], ['class' => 'small']) ?>
</div>

<!-- Login -->
<?= $this->AppForm->create(null, ['id' => 'loginForm']) ?>
<?= $this->AppForm->control('token', ['type' => 'hidden']) ?>
<?= $this->AppForm->end(); ?>

<?= $this->Html->script('https://www.gstatic.com/firebasejs/7.10.0/firebase-auth.js', ['block' => true]) ?>
<?= $this->Html->script('firebase-login', ['block' => true]) ?>
<!-- Login -->