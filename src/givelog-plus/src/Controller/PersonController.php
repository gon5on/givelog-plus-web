<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IPersonListUseCase;
use App\UseCase\IPersonAddUseCase;
use App\UseCase\IPersonEditUseCase;
use App\UseCase\IPersonDeleteUseCase;
use App\UseCase\IPersonViewUseCase;

class PersonController extends AppController {
    use InvokeActionTrait;

    public function index(IPersonListUseCase $personListUseCase, IPersonAddUseCase $personAddUseCase) {
        $this->set('pageTitle', '人物リスト');

        $uid = $this->Auth->user('uid');
        $persons = $personListUseCase->list($uid);
        $personCategories = $personAddUseCase->getParsonCategoryIdNameArray($uid);

        $this->set(compact('persons', 'personCategories'));
    }

    public function view(IPersonViewUseCase $personViewUseCase, IPersonEditUseCase $personEditUseCase, string $id) {
        $uid = $this->Auth->user('uid');
        $person = $personViewUseCase->view($uid, $id);
        $personCategories = $personEditUseCase->getParsonCategoryIdNameArray($uid);

        $this->set(compact('person', 'personCategories'));
    }

    public function add(IPersonAddUseCase $personAddUseCase) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $person = $personAddUseCase->add($uid, $data);

        return $this->getAjaxResponse($person);
    }

    public function edit(IPersonEditUseCase $personEditUseCase, string $id) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $person = $personEditUseCase->edit($uid, $id, $data);

        return $this->getAjaxResponse($person);
    }

    public function delete(IPersonDeleteUseCase $personDeleteUseCase, string $id) {
        if ($this->request->is('post')) {
            $uid = $this->Auth->user('uid');
            $personDeleteUseCase->delete($uid, $id);
        }

        return $this->redirect('/person');
    }
}
