<!DOCTYPE html>
<html lang="ja">
<head>
<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<?= $this->fetch('meta') ?>
<title>givelog plus | エラー</title>
<?= $this->Html->css('/vendor/fontawesome-free/css/all.min.css') ?>
<?= $this->Html->css('/vendor/sb-admin-2/sb-admin-2.min.css') ?>
<?= $this->Html->css('custom.css') ?>
<?= $this->fetch('css') ?>
</head>

<body class="bg-gradient-primary">

<div class="container">
<div class="row justify-content-center">
<div class="col-xl-6 col-lg-6 col-md-9">
<div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<div class="p-5">

<?= $this->fetch('content'); ?>

</div>
</div>
</div>
</div>
</div>
</div>

<?= $this->Html->script('https://code.jquery.com/jquery-3.4.1.min.js', ['integrity' => 'sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=', 'crossorigin' => 'anonymous']) ?>
<?= $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js') ?>
<?= $this->Html->script('/vendor/sb-admin-2/sb-admin-2.min') ?>

<?= $this->fetch('script') ?>
</body>
</html>