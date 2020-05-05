<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use Cake\Event\Event;
use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IEventListUseCase;
use App\UseCase\IEventAddUseCase;
use App\UseCase\IEventEditUseCase;
use App\UseCase\IEventDeleteUseCase;

class EventController extends AppController {
    use InvokeActionTrait;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        if (in_array($this->request->action, ['add', 'edit', 'delete'])) {
            if (!$this->request->is('ajax')) {
                return $this->redirect('/event');
            }
        }
    }

    public function index(IEventListUseCase $eventListUseCase) {
        $this->set('pageTitle', 'イベントリスト');

        $uid = $this->Auth->user('uid');
        $events = $eventListUseCase->list($uid);

        $this->set(compact('events'));
    }

    public function add(IEventAddUseCase $eventAddUseCase) {
        try {
            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $event = $eventAddUseCase->add($uid, $data);

            if ($event->getErrors()) {
                return $this->_getErrorAjaxResponse($event->getErrors());
            }

            $this->set(compact('event'));
            $this->render('/Element/event_table_tr');

            return $this->_getSuccessAjaxResponse('保存しました', $event, $this->response->body());
    
        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function edit(IEventEditUseCase $eventEditUseCase, string $id = null) {
        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $data = $this->request->getData();
            $event = $eventEditUseCase->edit($uid, $id, $data);

            if ($event->getErrors()) {
                return $this->_getErrorAjaxResponse($event->getErrors());
            }

            $this->set(compact('event'));
            $this->render('/Element/event_table_tr');

            return $this->_getSuccessAjaxResponse('保存しました', $event, $this->response->body());

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }

    public function delete(IEventDeleteUseCase $eventDeleteUseCase, string $id = null) {
        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $eventDeleteUseCase->delete($uid, $id);

            return $this->_getSuccessAjaxResponse('削除しました');

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }
}
