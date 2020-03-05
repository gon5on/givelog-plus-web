<?php
namespace App\Controller;

/**
 * ご利用規約コントローラ
 */
class TermsController extends AppController
{
    /**
     * インデックス
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'ご利用規約');
    }
}
