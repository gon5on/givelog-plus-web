<?php
namespace App\Controller;

/**
 * 人物リストコントローラ
 */
class PersonListController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', '人物リスト');
    }

    /**
     * 詳細アクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function view()
    {
        $this->set('page_title', '山田太郎くん');
    }
}
