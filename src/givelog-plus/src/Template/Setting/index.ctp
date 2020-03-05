<?php $this->assign('page_title', $page_title) ?>

<?php $withdrawModalTag = 'withdrawModal'; ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0" >
<tbody>

<tr data-modal="#accountChangeModal">
<td><i class="fas fa-fw fa-key"></i><span>メールアドレス/パスワード変更</span></td>
</tr>

<tr data-url="<?= $this->Url->build(['controller' => 'Information']) ?>">
<td><i class="fas fa-fw fa-exclamation-circle"></i><span>お知らせ</span></td>
</tr>

<tr data-url="<?= $this->Url->build(['controller' => 'About']) ?>">
<td><i class="fas fa-fw fa-gift"></i><span>givelog plus について</span></td>
</tr>

<tr data-url="<?= $this->Url->build(['controller' => 'Terms']) ?>">
<td><i class="fas fa-fw fa-file-alt"></i><span>ご利用規約</span></td>
</tr>

<tr data-url="https://www.e-2.co.jp/policy/" data-target="blank">
<td>
<div class="row">
<div class="col-auto mr-auto"><i class="fas fa-fw fa-lock"></i><span>プライバシーポリシー</span></div>
<div class="col-auto"><i class="fas fa-fw fa-external-link-alt"></i></div>
</div>
</td>
</tr>

<tr data-modal="#withdrawModal">
<td><i class="fas fa-fw fa-trash"></i><span>退会</span></td>
</tr>

</tbody>
</table>
</div>


<?= $this->element('account_change_modal') ?>

<?= $this->element('withdraw_modal') ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    let modal_id = $(this).data("modal");
    let url = $(this).data("url");
    let target_blank = $(this).data("target");

    if (modal_id) {
        $(modal_id).modal("show");
    } else {
        if (target_blank) {
            window.open(url, "_blank");
        } else {
            window.location.href = url;
        }
    }
});
<?= $this->Html->scriptEnd() ?>