<?php
namespace App\Controller;

/**
 * 設定コントローラ
 */
class SettingController extends AppController
{
    /**
     * インデックス
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', '設定');
    }
}
