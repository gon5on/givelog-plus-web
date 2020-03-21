<!DOCTYPE html>
<html lang="ja">
<head>
<?= $this->Html->charset() ?>
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

<body id="page-top">
<div id="wrapper">

<?= $this->element('menu') ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
<i class="fa fa-bars"></i>
</button>
<?= $this->Html->link('givelog plus', ['controller' => 'Gift']) ?>
</nav>

<div class="container-fluid">
<div class="row justify-content-md-center">
<div class="col-xl-6 col-lg-6 col-md-9">

<h1 class="h3 mb-4 text-gray-800">
<?= $this->fetch('page_title') ?><?= $this->fetch('person_category_label') ?>
</h1>

<?= $this->fetch('content'); ?>

</div>
</div>
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

<?= $this->Html->script('https://code.jquery.com/jquery-3.4.1.min.js', ['integrity' => 'sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=', 'crossorigin' => 'anonymous']) ?>
<?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js') ?>
<?= $this->Html->script('/vendor/sb-admin-2/sb-admin-2.min') ?>

<?= $this->Html->script('https://www.gstatic.com/firebasejs/7.10.0/firebase-app.js') ?>
<?= $this->Html->script('firebase-init') ?>

<?= $this->fetch('script') ?>

</body>
</html>