<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">アカウント新規作成</h1>
</div>

<p class="mb-4">以下をすべて入力して、新規作成ボタンを押してください。<br>
すぐに利用開始できます。</p>

<?= $this->AppForm->create(null, ['class' => 'user']) ?>

<label class="text-xs font-weight-bold">名前</label>
<?= $this->AppForm->control('name', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => '山田太郎']) ?>

<label class="text-xs font-weight-bold">メールアドレス</label>
<?= $this->AppForm->control('email', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => 'example@givelog.plus.com']) ?>

<label class="text-xs font-weight-bold">パスワード</label>
<?= $this->AppForm->control('password', ['label' => false, 'class' => 'form-control form-control-user', 'placeholder' => '**********']) ?>

<label class="text-xs font-weight-bold">パスワード再入力</label>
<?= $this->AppForm->control('passwordConfirm', ['label' => false, 'type' => 'password', 'class' => 'form-control form-control-user mb-4', 'placeholder' => '**********']) ?>

<?= $this->AppForm->button('新規作成', ['class' => 'btn btn-primary btn-user btn-block mb-4']) ?>
<?= $this->AppForm->end(); ?>

<hr>

<div class="text-center">
<?= $this->Html->link('< 戻る', ['controller' => 'Login'], ['class' => 'small']) ?>
</div>
