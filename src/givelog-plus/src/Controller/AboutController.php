<?php
namespace App\Controller;

class AboutController extends AppController {

    public function index() {
        $this->set('page_title', 'givelog plus について');
    }
}
