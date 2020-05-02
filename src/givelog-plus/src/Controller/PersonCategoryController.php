<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IPersonCategoryListUseCase;
use App\UseCase\IPersonCategoryAddUseCase;
use App\UseCase\IPersonCategoryEditUseCase;
use App\UseCase\IPersonCategoryDeleteUseCase;

class PersonCategoryController extends AppController {
    use InvokeActionTrait;

    public function index(IPersonCategoryListUseCase $personCategoryListUseCase) {
        $this->set('pageTitle', '人物カテゴリリスト');

        $uid = $this->Auth->user('uid');
        $personCategories = $personCategoryListUseCase->list($uid);

        $this->set(compact('personCategories'));
    }

    public function add(IPersonCategoryAddUseCase $personCategoryAddUseCase) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person-category');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $personCategory = $personCategoryAddUseCase->add($uid, $data);

        return $this->getAjaxResponse($personCategory);
    }

    public function edit(IPersonCategoryEditUseCase $personCategoryEditUseCase, string $id) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/person-category');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $personCategory = $personCategoryEditUseCase->edit($uid, $id, $data);

        return $this->getAjaxResponse($personCategory);
    }

    public function delete(IPersonCategoryDeleteUseCase $personCategoryDeleteUseCase, string $id) {
        if ($this->request->is('post')) {
            $uid = $this->Auth->user('uid');
            $personCategoryDeleteUseCase->delete($uid, $id);
        }

        return $this->redirect('/person-category');
    }
}
