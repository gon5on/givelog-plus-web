<?php $this->layout = 'error'; ?>

<div class="container-fluid">

<div class="text-center">
<div class="error mx-auto" data-text="404">404</div>
<p class="lead text-gray-800 mb-5">Page Not Found</p>
<?= $this->Html->link('< 戻る', ['controller' => 'Gift', 'action' => 'index'], ['class' => 'small']) ?>
</div>

</div>
