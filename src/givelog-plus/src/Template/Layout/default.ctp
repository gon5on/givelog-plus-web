<!DOCTYPE html>
<html lang="ja">
<head>
<?= $this->Html->charset() ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<?= $this->fetch('meta') ?>
<title>givelog plus | <?= $this->fetch('page_title') ?></title>
<?= $this->Html->css('/vendor/fontawesome-free/css/all.min.css') ?>
<?= $this->Html->css('/vendor/sb-admin-2/sb-admin-2.min.css') ?>
<?= $this->Html->css('custom.css') ?>
<?= $this->fetch('css') ?>
</head>

<body>
<div id="wrapper">

<?= $this->element('menu') ?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>
<?= $this->Html->link('givelog plus', ['controller' => 'GiftList']) ?>
</nav>

<div class="container-fluid">

<div class="d-sm-flex align-items-center mb-4 flex-title">
<h1 class="h3 mb-0 text-gray-800"><?= $this->fetch('page_title') ?></h1>
&nbsp;&nbsp;<?= $this->fetch('person_category_label') ?>
</div>

<?= $this->fetch('content'); ?>

</div>
</div>

<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
<span>Copyright &copy; givelog plus 2020</span>
</div>
</div>
</footer>

</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<?= $this->Html->script('/vendor/jquery/jquery.min') ?>
<?= $this->Html->script('/vendor/bootstrap/js/bootstrap.bundle.min') ?>
<?= $this->Html->script('/vendor/jquery-easing/jquery.easing.min') ?>
<?= $this->Html->script('/vendor/sb-admin-2/sb-admin-2.min.js') ?>
<?= $this->fetch('script') ?>

</body>
</html>