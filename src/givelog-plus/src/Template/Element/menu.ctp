<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

<?= $this->App->menu('プレゼントリスト', ['controller' => 'GiftList', 'action' => 'index'], 'fa-gift') ?>
<?= $this->App->menu('プレゼント追加', ['controller' => 'GiftAdd', 'action' => 'index'], 'fa-plus-circle') ?>

<hr class="sidebar-divider my-0">

<?= $this->App->menu('人物リスト', ['controller' => 'PersonList', 'action' => 'index'], 'fa-user-friends') ?>
<?= $this->App->menu('人物カテゴリリスト', ['controller' => 'PersonCategoryList', 'action' => 'index'], 'fa-folder-open') ?>
<?= $this->App->menu('イベントリスト', ['controller' => 'EventList', 'action' => 'index'], 'fa-calendar-alt') ?>

<hr class="sidebar-divider my-0">

<?= $this->App->menu('設定', ['controller' => 'Setting', 'action' => 'index'], 'fa-cog') ?>

<li class="nav-item ">
<a class="nav-link" href="javascript::void(0)" data-toggle="modal" data-target="#logoutModal">
<i class="fas fa-fw fa-sign-out-alt"></i><span>ログアウト</span>
</a>
</li>

<hr class="sidebar-divider d-none d-md-block">

<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>

<?= $this->element('logout_modal') ?>