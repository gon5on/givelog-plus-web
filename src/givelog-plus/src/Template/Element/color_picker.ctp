<!-- color picker -->
<?= $this->Html->css('/vendor/bootstrap-colorpickersliders/bootstrap.colorpickersliders.min', ['block' => true]) ?>
<?= $this->Html->css('custom_colorpickersliders', ['block' => true]) ?>

<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.1/tinycolor.min.js', ['block' => true]) ?>
<?= $this->Html->script('/vendor/bootstrap-colorpickersliders/bootstrap.colorpickersliders.min', ['block' => true]) ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("#hslflat").ColorPickerSliders({
    flat: true,
    swatches: ['#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3', '#03A9F4', '#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107', '#FF9800', '#FF5722', '#795548', '#9E9E9E', '#607D8B', '#000000'],
    sliders: false,
    customswatches: false
});
<?= $this->Html->scriptEnd() ?>
<!-- color picker -->
