<?php
namespace App\Controller;

/**
 * イベントリストコントローラ
 */
class EventListController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'イベントリスト');
    }
}
