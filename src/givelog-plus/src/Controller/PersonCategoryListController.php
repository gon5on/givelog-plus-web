<?php
namespace App\Controller;

/**
 * 人物カテゴリリストコントローラ
 */
class PersonCategoryListController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', '人物カテゴリリスト');
    }
}
