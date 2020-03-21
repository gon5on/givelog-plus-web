<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IEventListUseCase;
use App\UseCase\IEventAddUseCase;
use App\UseCase\IEventEditUseCase;
use App\UseCase\IEventDeleteUseCase;

class EventController extends AppController {
    use InvokeActionTrait;

    public function index(IEventListUseCase $eventListUseCase) {
        $this->set('page_title', 'イベントリスト');

        $uid = $this->Auth->user('uid');
        $events = $eventListUseCase->list($uid);

        $this->set(compact('events'));
    }

    public function add(IEventAddUseCase $eventAddUseCase) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/event');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $event = $eventAddUseCase->add($uid, $data);

        return $this->getAjaxResponse($event);
    }

    public function edit(IEventEditUseCase $eventEditUseCase, string $id) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/event');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $event = $eventEditUseCase->edit($uid, $id, $data);

        return $this->getAjaxResponse($event);
    }

    public function delete(IEventDeleteUseCase $eventDeleteUseCase, string $id) {
        if ($this->request->is('post')) {
            $uid = $this->Auth->user('uid');
            $eventDeleteUseCase->delete($uid, $id);
        }

        return $this->redirect('/event');
    }
}
