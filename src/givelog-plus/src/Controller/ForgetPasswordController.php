<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * パスワード再発行コントローラ
 */
class ForgetPasswordController extends AppController
{
    /**
     * beforeFilter
     * 
     * @param Event event
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        
        $this->viewBuilder()->setLayout('before_login');
    }

    /**
     * 入力画面
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'パスワード再発行');

        if ($this->request->is('post')) {
            return $this->render('finish');
        }
    }
}
