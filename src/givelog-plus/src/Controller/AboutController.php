<?php
namespace App\Controller;

/**
 * givelog plus についてコントローラ
 */
class AboutController extends AppController
{
    /**
     * インデックス
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'givelog plus について');
    }
}
