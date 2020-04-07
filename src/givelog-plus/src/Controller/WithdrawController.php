<?php
namespace App\Controller;

class EventListController extends AppController {

    public function index() {
        $this->request->allowMethod(['post']);

        $this->redirect(['Controller' => 'Login']);
    }
}
