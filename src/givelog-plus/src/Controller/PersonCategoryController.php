<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\Datasource\Exception\RecordNotFoundException;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IPersonCategoryListUseCase;
use App\UseCase\IPersonCategoryAddUseCase;
use App\UseCase\IPersonCategoryEditUseCase;
use App\UseCase\IPersonCategoryDeleteUseCase;

class PersonCategoryController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        if (in_array($this->request->action, ['add', 'edit', 'delete'])) {
            if (!$this->request->is('ajax')) {
                return $this->redirect('/person-category');
            }
        }
    }

    public function index(IPersonCategoryListUseCase $personCategoryListUseCase) {
        $this->set('pageTitle', '人物カテゴリリスト');

        $uid = $this->Auth->user('uid');
        $personCategories = $personCategoryListUseCase->list($uid);

        $this->set(compact('personCategories'));
    }

    public function add(IPersonCategoryAddUseCase $personCategoryAddUseCase) {
        try {
            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $personCategory = $personCategoryAddUseCase->add($uid, $data);

            if ($personCategory->getErrors()) {
                return $this->_getErrorAjaxResponse($personCategory->getErrors());
            }

            $this->set(compact('personCategory'));
            $this->render('/Element/person_category_table_tr');

            return $this->_getSuccessAjaxResponse('保存しました', $personCategory, $this->response->body());
    
        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function edit(IPersonCategoryEditUseCase $personCategoryEditUseCase, string $id = null) {
        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $personCategory = $personCategoryEditUseCase->edit($uid, $id, $data);

            if ($personCategory->getErrors()) {
                return $this->_getErrorAjaxResponse($personCategory->getErrors());
            }

            $this->set(compact('personCategory'));
            $this->render('/Element/person_category_table_tr');

            return $this->_getSuccessAjaxResponse('保存しました', $personCategory, $this->response->body());

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function delete(IPersonCategoryDeleteUseCase $personCategoryDeleteUseCase, string $id = null) {
        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $personCategoryDeleteUseCase->delete($uid, $id);

            return $this->_getSuccessAjaxResponse('削除しました');

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }
}
