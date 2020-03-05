<?php
namespace App\Controller;

/**
 * お知らせコントローラ
 */
class InformationController extends AppController
{
    /**
     * インデックス
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'お知らせ');
    }
}
