<?php
namespace App\Controller;

use Cake\Event\Event;

class LoginController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['logout']);

        $this->viewBuilder()->setLayout('before_login');
    }

    public function index() {
        $this->set('pageTitle', 'ログイン');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
