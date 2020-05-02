<?php
namespace App\Controller;

class InformationController extends AppController {

    public function index() {
        $this->set('pageTitle', 'お知らせ');
    }
}
