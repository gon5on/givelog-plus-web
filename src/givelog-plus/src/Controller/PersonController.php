<?php
namespace App\Controller;

use App\UseCase\IPersonUseCase;

class PersonController extends AppController {
    private $personUseCase;

    public function di(IPersonUseCase $personUseCase) {
        $this->personUseCase = $personUseCase;
    }

    public function index() {
        $this->set('page_title', '人物リスト');

        $uid = $this->Auth->user('uid');
        $persons = $this->personUseCase->list($uid);

        $this->set(compact('persons'));
    }

    public function add() {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $person = $this->personUseCase->add($uid, $data);

        return $this->getAjaxResponse($person);
    }

    public function view($id) {
        $uid = $this->Auth->user('uid');
        $person = $this->personUseCase->view($uid, $id);

        $this->set(compact('person'));
    }

    public function edit($id) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $person = $this->personUseCase->edit($uid, $id, $data);

        return $this->getAjaxResponse($person);
    }
}
