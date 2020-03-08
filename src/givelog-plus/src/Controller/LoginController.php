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

        $this->Auth->allow(['logout']);

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
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
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
