<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<?= $this->App->menu('プレゼントリスト', ['controller' => 'GiftList'], 'fa-gift') ?>
<?= $this->App->menu('プレゼント追加', ['controller' => 'GiftAdd'], 'fa-plus-circle') ?>

<hr class="sidebar-divider my-0">

<?= $this->App->menu('人物リスト', ['controller' => 'PersonList'], 'fa-user-friends') ?>
<?= $this->App->menu('人物カテゴリリスト', ['controller' => 'PersonCategoryList'], 'fa-folder-open') ?>
<?= $this->App->menu('イベントリスト', ['controller' => 'EventList'], 'fa-calendar-alt') ?>

<hr class="sidebar-divider my-0">

<?= $this->App->menu('設定', ['controller' => 'Setting'], 'fa-cog') ?>
<?= $this->App->menu('ログアウト', ['controller' => 'Logout'], 'fa-sign-out-alt') ?>

<hr class="sidebar-divider d-none d-md-block">

<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
