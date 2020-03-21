<?php
namespace App\Controller;

use App\UseCase\IEventUseCase;

class EventController extends AppController {
    private $eventUseCase;

    public function di(IEventUseCase $eventUseCase) {
        $this->eventUseCase = $eventUseCase;
    }

    public function index() {
        $this->set('page_title', 'イベントリスト');

        $uid = $this->Auth->user('uid');
        $events = $this->eventUseCase->list($uid);

        $this->set(compact('events'));
    }

    public function add() {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/event');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $event = $this->eventUseCase->add($uid, $data);

        return $this->getAjaxResponse($event);
    }

    public function edit($id) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/event');
        }

        $uid = $this->Auth->user('uid');
        $data = $this->request->getData();
        $event = $this->eventUseCase->edit($uid, $id, $data);

        return $this->getAjaxResponse($event);
    }

    public function delete($id) {
        if ($this->request->is('post')) {
            $uid = $this->Auth->user('uid');
            $this->eventUseCase->delete($uid, $id);
        }

        return $this->redirect('/event');
    }
}
