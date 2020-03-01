<?php
namespace App\Controller;

/**
 * プレゼント追加コントローラ
 */
class GiftAddController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'プレゼント追加');
    }
}
