<?php
namespace App\Controller;

/**
 * プレゼント編集コントローラ
 */
class GiftEditController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'プレゼント編集');

        $this->render('/GiftAdd/index');
    }
}
