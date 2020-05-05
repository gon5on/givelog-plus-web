<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\Datasource\Exception\RecordNotFoundException;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IPersonListUseCase;
use App\UseCase\IPersonAddUseCase;
use App\UseCase\IPersonEditUseCase;
use App\UseCase\IPersonDeleteUseCase;
use App\UseCase\IPersonViewUseCase;

class PersonController extends AppController {
    use InvokeActionTrait;
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        if (in_array($this->request->action, ['add', 'edit', 'delete'])) {
            if (!$this->request->is('ajax')) {
                return $this->redirect('/person');
            }
        }
    }

    public function index(IPersonListUseCase $personListUseCase, IPersonAddUseCase $personAddUseCase) {
        $this->set('pageTitle', '人物リスト');

        $uid = $this->Auth->user('uid');
        $persons = $personListUseCase->list($uid);
        $personCategories = $personAddUseCase->getParsonCategoryIdNameArray($uid);

        $this->set(compact('persons', 'personCategories'));
    }

    public function view(IPersonViewUseCase $personViewUseCase, IPersonEditUseCase $personEditUseCase, string $id = null) {
        if (!$id) {
            return $this->redirect('/person');
        }

        $uid = $this->Auth->user('uid');
        $person = $personViewUseCase->view($uid, $id);
        $personCategories = $personEditUseCase->getParsonCategoryIdNameArray($uid);

        $this->set(compact('person', 'personCategories'));
    }

    public function add(IPersonAddUseCase $personAddUseCase) {
        try {
            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $person = $personAddUseCase->add($uid, $data);

            if ($person->getErrors()) {
                return $this->_getErrorAjaxResponse($person->getErrors());
            }

            $this->set(compact('person'));
            $this->render('/Element/person_table_tr');

            return $this->_getSuccessAjaxResponse('保存しました', $person, $this->response->body());
    
        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function edit(IPersonEditUseCase $personEditUseCase, string $id = null) {
        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $person = $personEditUseCase->edit($uid, $id, $data);

            if ($person->getErrors()) {
                return $this->_getErrorAjaxResponse($person->getErrors());
            }

            $this->set(compact('person'));
            $this->render('/Element/person_table_tr');

            return $this->_getSuccessAjaxResponse('保存しました', $person, $this->response->body());

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function delete(IPersonDeleteUseCase $personDeleteUseCase, string $id = null) {
        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $personDeleteUseCase->delete($uid, $id);

            return $this->_getSuccessAjaxResponse('削除しました');

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }
}
