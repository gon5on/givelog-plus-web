<?php
namespace App\Controller;

/**
 * プレゼントリストコントローラ
 */
class GiftListController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'プレゼントリスト');
    }

    /**
     * 詳細アクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function view()
    {
        $this->set('page_title', 'プレゼント詳細');
    }
}
