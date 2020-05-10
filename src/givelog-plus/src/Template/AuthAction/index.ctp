<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">パスワード再発行</h1>
</div>

<div id="input">
<p class="mb-4">新しいパスワードを入力してください。</p>

<label class="text-xs font-weight-bold">パスワード</label>
<?= $this->AppForm->control('password', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => '**********']) ?>

<label class="text-xs font-weight-bold">パスワード再入力</label>
<?= $this->AppForm->control('passwordConfirm', ['label' => false, 'type' => 'password', 'class' => 'form-control form-control-user mb-4', 'placeholder' => '**********']) ?>

<button id="save" class="btn btn-primary btn-user btn-block mb-4">保存</button>
</div>

<div id="finish" style="display:none">
<p class="mb-4">パスワードを変更しました。</p>

<button id="newPasswordLogin" class="btn btn-primary btn-user btn-block mb-4">Givelog+ へ</button>

</div>

<hr>

<div class="text-center">
<?= $this->Html->link('< ログインページへ', ['controller' => 'Login'], ['class' => 'small']) ?>
</div>


<?= $this->element('hidden_login'); ?>

<?= $this->Html->script('https://www.gstatic.com/firebasejs/7.10.0/firebase-auth.js', ['block' => true]) ?>
<?= $this->Html->script('firebase-authaction', ['block' => true]) ?>
