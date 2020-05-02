<?php
namespace App\Controller;

class AboutController extends AppController {

    public function index() {
        $this->set('pageTitle', 'givelog plus について');
    }
}
