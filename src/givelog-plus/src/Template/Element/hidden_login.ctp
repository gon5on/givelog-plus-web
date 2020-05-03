<!-- Login -->
<?= $this->AppForm->create(null, ['id' => 'loginForm']) ?>
<?= $this->AppForm->control('token', ['type' => 'hidden']) ?>
<?= $this->AppForm->end(); ?>

<?= $this->Html->script('https://www.gstatic.com/firebasejs/7.10.0/firebase-auth.js', ['block' => true]) ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js', ['block' => true]) ?>
<?= $this->Html->script('firebase-login', ['block' => true]) ?>

<?php if (isset($email) && isset($password)): ?>
<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
let email = '<?= $email ?>';
let password = '<?= $password ?>';
<?= $this->Html->scriptEnd() ?>
<?php endif; ?>
<!-- Login -->