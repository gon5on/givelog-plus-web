<?php
use Cake\Core\Configure;
use App\Model\Entity\Gift;

if (!isset($gift)) {
    $gift = new Gift();
}
extract($gift->toArrayWithDefaultKey());
?>

<?php $this->assign('pageTitle', $pageTitle) ?>

<?= $this->AppForm->create(null, ['enctype' => 'multipart/form-data']) ?>

<div class="label-area">
<i class="fas fa-fw fa-exchange-alt"></i><span class="text-xs font-weight-bold">タイプ</span>
</div>
<?= $this->AppForm->segmentedControl('type', ['type' => 'radio', 'label' => false, 'options' => Configure::read('types'), 'value' => $type]) ?>

<div class="label-area">
<i class="fas fa-fw fa-calendar-day"></i><span class="text-xs font-weight-bold">日付</span>
</div>

<div class="form-group input-group date" id="datetimepicker" data-target-input="nearest">
<input type="text" name="date" class="form-control datetimepicker-input" data-target="#datetimepicker" value="<?= $date ?>" />
<div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div>
</div>

<div class="label-area">
<i class="fas fa-fw fa-user"></i><span class="text-xs font-weight-bold">だれから</span>
</div>

<div class="form-group">
<select name="fromPersonIds[]" id="example-multiple-optgroups" multiple="multiple">
<?php foreach($persons as $personCategoryName => $inCategoryPersons): ?>
<optgroup label="<?= $personCategoryName ?>">
<?php foreach($inCategoryPersons as $person_id => $name): ?>
<option value="<?= $person_id ?>"><?= $name ?></option>
<?php endforeach; ?>
</optgroup>
<?php endforeach; ?>
</select>
</div>

<div class="text-right form-group-mergin-minus">
<a href="javascript::void(0)" class="small " data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物追加</a>
</div>

<div class="label-area">
<i class="fas fa-fw fa-user"></i><span class="text-xs font-weight-bold">だれへ</span>
</div>

<div class="form-group">
<select name="toPersonIds[]" id="example-multiple-optgroups2" multiple="multiple">
<?php foreach($persons as $personCategoryName => $inCategoryPersons): ?>
    <optgroup label="<?= $personCategoryName ?>">
    <?php foreach($inCategoryPersons as $person_id => $name): ?>
        <option value="<?= $person_id ?>"><?= $name ?></option>
    <?php endforeach; ?>
    </optgroup>
<?php endforeach; ?>
</select>
</div>

<div class="text-right form-group-mergin-minus">
<a href="javascript::void(0)" class="small" data-toggle="modal" data-target="#personAddModal"><i class="fas fa-fw fa-plus-circle"></i>人物追加</a>
</div>

<div class="label-area">
<i class="fas fa-fw fa-gift"></i><span class="text-xs font-weight-bold">プレゼント</span>
</div>
<?= $this->AppForm->control('gift', ['label' => false, 'type' => 'textarea', 'class' => 'form-control', 'rows'=> 2, 'value' => $gift]) ?>

<div class="label-area">
<i class="fas fa-fw fa-calendar-check"></i><span class="text-xs font-weight-bold">イベント</span>
</div>
<?= $this->AppForm->control('eventId', ['label' => false, 'empty' => '選んでください', 'class' => 'custom-select', 'options' => $events, 'value' => $eventId]) ?>

<div class="text-right form-group-mergin-minus">
<a href="javascript::void(0)" class="small" data-toggle="modal" data-target="#eventAddModal"><i class="fas fa-fw fa-plus-circle"></i>イベント追加</a>
</div>

<div class="label-area">
<i class="fas fa-fw fa-dollar-sign"></i><span class="text-xs font-weight-bold">金額</span>
</div>
<?= $this->AppForm->control('price', ['label' => false, 'class' => 'form-control', 'placeholder' => '3000円くらい', 'value' => $price]) ?>

<div class="label-area">
<i class="fas fa-fw fa-window-restore"></i><span class="text-xs font-weight-bold">URL</span>
</div>
<?= $this->AppForm->control('url', ['label' => false, 'class' => 'form-control', 'placeholder' => 'https://givelog.jp/for-you', 'value' => $url]) ?>

<div class="label-area">
<i class="fas fa-fw fa-image"></i><span class="text-xs font-weight-bold">画像</span>
</div>
<div class="custom-file form-group">
<?= $this->AppForm->control('image', ['label' => false, 'type' => 'file', 'class' => 'custom-file-input']) ?>
<label class="custom-file-label"></label>
</div>

<?php if ($imagePath): ?>
<div id="imageArea" class="mb-4">
<img src="<?= $this->Url->build(['controller' => 'File', 'action' => 'giftImage', $id, $imageFileName]) ?>">
<?= $this->AppForm->control('imageDeleteFlg', ['type' => 'hidden']) ?>
<a href="javascript::void(0)" class="small" id="deleteImage"><i class="fas fa-fw fa-trash"></i>削除</a>
</div>
<?php endif; ?>


<div class="label-area">
<i class="fas fa-fw fa-pen"></i><span class="text-xs font-weight-bold">メモ</span>
</div>
<?= $this->AppForm->control('memo', ['label' => false, 'type' => 'textarea', 'class' => 'form-control mb-4', 'rows'=> 5, 'value' => $memo]) ?>

<?= $this->AppForm->control('id', ['type' => 'hidden', 'value' => $id]) ?>

<?= $this->AppForm->button('保存', ['class' => 'btn btn-primary btn-user btn-block mb-4']) ?>
<?= $this->AppForm->end(); ?>


<?= $this->element('person_add_modal') ?>

<?= $this->element('event_add_modal') ?>

<?= $this->element('color_picker') ?>

<?= $this->element('date_picker') ?>


<!-- multi select -->
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css', ['block' => true]) ?>

<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js', ['block' => true]) ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$('#example-multiple-optgroups').multiselect({
    nonSelectedText: '',
    buttonWidth: '100%',
    buttonText: function(options, select) {
        if (options.length === 0) {
            return '選択してください';
        } else {
            let labels = [];
            options.each(function() {
                if ($(this).attr('label') !== undefined) {
                    labels.push($(this).attr('label'));
                }
                else {
                    labels.push($(this).html());
                }
            });
            return labels.join(', ') + '';
        }
    }
});

$('#example-multiple-optgroups2').multiselect({
    nonSelectedText: '',
    buttonWidth: '100%',
    buttonText: function(options, select) {
        if (options.length === 0) {
            return '選択してください';
        } else {
            let labels = [];
            options.each(function() {
                if ($(this).attr('label') !== undefined) {
                    labels.push($(this).attr('label'));
                }
                else {
                    labels.push($(this).html());
                }
            });
            return labels.join(', ') + '';
        }
    }
});

$('#deleteImage').on('click', function() {
    $('#imageArea').hide();
    $('input[name="imageDeleteFlg"]').val('true');
});
<?= $this->Html->scriptEnd() ?>
<!-- multi select -->
