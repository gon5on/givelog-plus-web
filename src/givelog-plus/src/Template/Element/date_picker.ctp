<!-- date picker -->
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js', ['block' => true]) ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js', ['block' => true]) ?>

<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css', ['block' => true]) ?>
<?= $this->Html->css('custom_datepicker', ['block' => true]) ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$(function () {
    $('#datetimepicker').datetimepicker({
        locale: 'ja',
        dayViewHeaderFormat: 'YYYY年 MM月',
        format: 'YYYY/MM/DD',
        locale: 'ja',
    });
});
<?= $this->Html->scriptEnd() ?>
<!-- date picker -->