<?php
namespace App\Controller;

class SettingController extends AppController {

    public function index() {
        $this->set('pageTitle', '設定');

        $this->set('email', $this->Auth->user('email'));
    }
}
