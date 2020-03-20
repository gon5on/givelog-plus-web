<?php
namespace App\Controller;

use Cake\Log\Log;
use App\UseCase\IPersonCategoryUseCase;


class PersonCategoryController extends AppController {
    private $personCategoryUseCase;

    public function di(IPersonCategoryUseCase $personCategoryUseCase) {
        $this->personCategoryUseCase = $personCategoryUseCase;
    }

    public function index() {
        $this->set('page_title', '人物カテゴリリスト');

        $uid = $this->Auth->user('uid');
        $personCategories = $this->personCategoryUseCase->list($uid);

        $this->set(compact('personCategories'));
    }

    public function add() {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person-category');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $entity = $this->personCategoryUseCase->add($uid, $data);

        return $this->getAjaxResponse($entity);
    }

    public function edit($documentId) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person-category');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $entity = $this->personCategoryUseCase->edit($uid, $documentId, $data);

        return $this->getAjaxResponse($entity);
    }

    public function delete($documentId) {
        if ($this->request->is('post')) {
            $uid = $this->Auth->user('uid');
            $this->personCategoryUseCase->delete($uid, $documentId);
        }

        return $this->redirect('/person-category');
    }
}
