<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IGiftListUseCase;
use App\UseCase\IGiftViewUseCase;
use App\UseCase\IGiftAddUseCase;
use App\UseCase\IPersonAddUseCase;
use App\UseCase\IEventAddUseCase;

class GiftController extends AppController {
    use InvokeActionTrait;

    public function index(IGiftListUseCase $giftListUseCase) {
        $this->set('page_title', 'プレゼントリスト');

        $uid = $this->Auth->user('uid');
        $gifts = $giftListUseCase->list($uid);

        $this->set(compact('gifts'));
    }

    public function view(IGiftViewUseCase $giftViewUseCase, string $id) {
        $this->set('page_title', 'プレゼント詳細');

        $uid = $this->Auth->user('uid');
        $gift = $giftViewUseCase->view($uid, $id);

        $this->set(compact('gift'));
    }

    public function add(IGiftAddUseCase $giftAddUseCase, IPersonAddUseCase $personAddUseCase, IEventAddUseCase $eventAddUseCase) {
        $this->set('page_title', 'プレゼント追加');

        $uid = $this->Auth->user('uid');
        $persons = $giftAddUseCase->getPersonIdNameArrayWithCategory($uid);
        $events = $giftAddUseCase->getEventIdNameArray($uid);
        $personCategories = $personAddUseCase->getParsonCategoryIdNameArray($uid);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $gift = $giftAddUseCase->add($uid, $data);

            if (!$gift->getErrors()) {
                $this->redirect('/gift');
            }
        }

        $this->set(compact('persons', 'events', 'personCategories'));
    }

    // public function edit(string $id) {
    //     $this->set('page_title', 'プレゼント編集');

    //     $this->render('add');
    // }

    // public function delete(string $id) {
    //     $this->redirect()
    // }
}
