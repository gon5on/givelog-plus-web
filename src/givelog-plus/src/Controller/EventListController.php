<?php
namespace App\Controller;

use App\Interactor\EventListInteractor;

class EventListController extends AppController {
    private $eventListInteractor;

    public function initialize() {
        $this->eventListInteractor = new EventListInteractor();
    }

    public function index()
    {
        $this->set('page_title', 'イベントリスト');

        try {
            $uid = $this->Auth->user('uid');
            $events = $this->eventListInteractor->handle($uid);

        } catch (FirebaseException $e) {
            //TODO
            debug($e->getMessage());
        }
    }
}
