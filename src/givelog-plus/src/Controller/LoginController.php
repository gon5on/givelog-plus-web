<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * ログインコントローラ
 */
class LoginController extends AppController
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
     * ログインアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', 'ログイン');

        if ($this->request->is('post')) {
            return $this->redirect('/gift-list');
        }
    }

    /**
     * ログアウトアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        return $this->redirect('/login');
    }
}
