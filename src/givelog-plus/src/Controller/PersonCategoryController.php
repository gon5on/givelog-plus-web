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

        try {
            $uid = $this->Auth->user('uid');
            $personCategories = $this->personCategoryUseCase->list($uid);

            $this->set(compact('personCategories'));

        } catch (FirebaseException $e) {
            //TODO
            debug($e->getMessage());
        }
    }

    public function add() {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person-category');
        }

        try {
            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $this->personCategoryUseCase->add($uid, $data);

            return $this->getResponse();
        } catch (FirebaseException $e) {
            //TODO
            debug($e->getMessage());
        }
    }

    public function edit($documentId) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person-category');
        }

        try {
            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $this->personCategoryUseCase->edit($uid, $documentId, $data);

            return $this->getResponse();
        } catch (FirebaseException $e) {
            //TODO
            debug($e->getMessage());
        }
    }

    public function delete($documentId) {
        if ($this->request->is('post')) {
            try {
                $uid = $this->Auth->user('uid');
                $this->personCategoryUseCase->delete($uid, $documentId);
    
            } catch (FirebaseException $e) {
                //TODO
                debug($e->getMessage());
            }
        }

        return $this->redirect('/person-category');
    }
}
