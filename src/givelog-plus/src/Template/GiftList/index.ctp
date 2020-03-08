<?php $this->assign('page_title', $page_title) ?>

<div class="mb-2">

<a class="small" data-toggle="collapse" href="#collapseExample">▶絞り込み</a>
<div class="collapse mb-4" id="collapseExample">
<div class="card card-body">

<div>
<i class="fas fa-fw fa-folder-open"></i><span class="text-xs font-weight-bold">人物カテゴリ</span>
</div>

<div class="mb-2">
<span class="badge badge-pill badge-primary">家族</span>&nbsp;
<span class="badge badge-pill badge-success-outline">親戚</span>&nbsp;
<span class="badge badge-pill badge-info-outline">友達</span>&nbsp;
<span class="badge badge-pill badge-danger-outline">会社</span>&nbsp;
</div>

<div>
<i class="fas fa-fw fa-calendar-check"></i><span class="text-xs font-weight-bold">イベント</span>
</div>

<div class="mb-2">
<span class="badge badge-pill badge-success-outline">クリスマス</span>&nbsp;
<span class="badge badge-pill badge-primary-outline">誕生日</span>&nbsp;
<span class="badge badge-pill badge-danger-outline">こどもの日</span>&nbsp;
<span class="badge badge-pill badge-info">母の日</span>&nbsp;
<span class="badge badge-pill badge-info-outline">結婚祝い</span>&nbsp;
<span class="badge badge-pill badge-success">父の日</span>&nbsp;
<span class="badge badge-pill badge-primary-outline">出産祝い</span>&nbsp;
<span class="badge badge-pill badge-danger-outline">新築祝い</span>&nbsp;
</div>

</div>
</div>

</div>


<div class="row">

<div class="col-xl-3 col-md-6 mb-3">
<div class="card shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="badge-area">
<span class="badge badge-pill badge-primary">家族</span>
<span class="badge badge-pill badge-info">母の日</span>
</div>
<span>2020/01/23</span>
<div class="h6 mb-0 font-weight-bold text-gray-800">
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">自分</a> から
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">母</a> へ<br>
カーネーションの花束と抹茶ケーキ
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
<div class="card shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="badge-area">
<span class="badge badge-pill badge-danger">会社</span>
<span class="badge badge-pill badge-info">結婚祝い</span>
</div>
<span>2020/01/23</span>
<div class="h6 mb-0 font-weight-bold text-gray-800">
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">社員一同</a> から
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">自分</a> へ<br>
圧力なべとレシピ集
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
<div class="card shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="badge-area">
<span class="badge badge-pill badge-info">高校友達</span>
<span class="badge badge-pill badge-danger">誕生日</span>
</div>
<span>2020/01/23</span>
<div class="h6 mb-0 font-weight-bold text-gray-800">
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">山田花子さん</a>、<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">佐藤洋子さん</a>から
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">自分</a> へ<br>
ワイヤレスイヤホン
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
<div class="card shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="badge-area">
<span class="badge badge-pill badge-info">大学友達</span>
<span class="badge badge-pill badge-success">新築祝い</span>
</div>
<span>2020/01/23</span>
<div class="h6 mb-0 font-weight-bold text-gray-800">
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">自分</a> から
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">鈴木次郎くん</a> へ<br>
キーケース
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
<div class="card shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="badge-area">
<span class="badge badge-pill badge-primary">家族</span>
<span class="badge badge-pill badge-info">こどもの日</span>
</div>
<span>2020/01/23</span>
<div class="h6 mb-0 font-weight-bold text-gray-800">
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">自分</a> から
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">太郎君</a> へ<br>
ミニカーコレクション
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6 mb-3">
<div class="card shadow h-100 py-2">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="badge-area">
<span class="badge badge-pill badge-danger">会社</span>
<span class="badge badge-pill badge-success">結婚祝い</span>
</div>
<span>2020/01/23</span>
<div class="h6 mb-0 font-weight-bold text-gray-800">
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">社員一同</a> から
<a href="<?= $this->Url->build(['controller' => 'PersonList', 'action' => 'view']) ?>">自分</a> へ<br>
圧力なべとレシピ集
</div>
</div>
</div>
</div>
</div>
</div>

</div>
