<?php
use App\Repository\UserRepository;
?>

<?php $this->assign('pageTitle', $pageTitle) ?>

<div class="table table-hover">
<table class="table" id="dataTable" width="100%" cellspacing="0" >
<tbody>

<?php if ($this->request->session()->read('Auth.User.provider') == UserRepository::PROVIDER_PASSWORD): ?>
<tr data-modal="#userEditModal">
<td><i class="fas fa-fw fa-key"></i><span>メールアドレス/パスワード変更</span></td>
</tr>
<?php endif; ?>

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

<?= $this->element('withdraw_modal') ?>

<?php if ($this->request->session()->read('Auth.User.provider') == UserRepository::PROVIDER_PASSWORD): ?>
<?= $this->element('user_edit_modal') ?>
<?php endif; ?>

<?= $this->Html->scriptStart(['block' => true, 'type' => 'text/javascript']) ?>
$("tbody tr").on("click",function(e) {
    let modalId = $(this).data("modal");
    let url = $(this).data("url");
    let targetBlank = $(this).data("target");

    if (modalId) {
        $(modalId).modal("show");
    } else {
        if (targetBlank) {
            window.open(url, "_blank");
        } else {
            window.location.href = url;
        }
    }
});
<?= $this->Html->scriptEnd() ?>