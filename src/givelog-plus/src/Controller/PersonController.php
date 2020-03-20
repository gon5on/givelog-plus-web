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
        $entity = $this->personUseCase->add($uid, $data);

        return $this->getAjaxResponse($entity);
    }

    public function view() {
        $this->set('page_title', '山田太郎くん');
    }
}
