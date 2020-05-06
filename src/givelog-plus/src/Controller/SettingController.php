<?php
namespace App\Controller;

class SettingController extends AppController {

    public function index() {
        $this->set('pageTitle', 'サポート');

        $this->set('email', $this->Auth->user('email'));
    }
}
