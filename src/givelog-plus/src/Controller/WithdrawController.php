<?php
namespace App\Controller;

/**
 * 退会コントローラ
 */
class EventListController extends AppController
{
    /**
     * インデックス
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post']);

        $this->redirect(['Controller' => 'Login']);
    }
}
