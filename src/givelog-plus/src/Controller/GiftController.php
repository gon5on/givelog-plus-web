<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IGiftListUseCase;
use App\UseCase\IGiftViewUseCase;
use App\UseCase\IGiftAddUseCase;
use App\UseCase\IGiftEditUseCase;
use App\UseCase\IGiftDeleteUseCase;
use App\UseCase\IPersonAddUseCase;
use App\UseCase\IEventAddUseCase;
use App\Model\Entity\Gift;

class GiftController extends AppController {
    use InvokeActionTrait;

    public function index(IGiftListUseCase $giftListUseCase) {
        $this->set('pageTitle', 'プレゼントリスト');

        $uid = $this->Auth->user('uid');
        $gifts = $giftListUseCase->list($uid);

        $this->set(compact('gifts'));
    }

    public function view(IGiftViewUseCase $giftViewUseCase, string $id = null) {
        if (!$id) {
            return $this->redirect('/gift');
        }

        $this->set('pageTitle', 'プレゼント詳細');

        $uid = $this->Auth->user('uid');
        $gift = $giftViewUseCase->view($uid, $id);

        $this->set(compact('gift'));
    }

    public function add(IGiftAddUseCase $giftAddUseCase, IPersonAddUseCase $personAddUseCase) {
        $this->set('pageTitle', 'プレゼント追加');

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

    public function edit(IGiftEditUseCase $giftEditUseCase, IPersonAddUseCase $personAddUseCase, string $id = null) {
        if (!$id) {
            return $this->redirect('/gift');
        }

        $this->set('pageTitle', 'プレゼント編集');

        $uid = $this->Auth->user('uid');
        $gift = $giftEditUseCase->get($uid, $id);
        $persons = $giftEditUseCase->getPersonIdNameArrayWithCategory($uid);
        $events = $giftEditUseCase->getEventIdNameArray($uid);
        $personCategories = $personAddUseCase->getParsonCategoryIdNameArray($uid);

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $gift = $giftEditUseCase->edit($uid, $id, $data);

            if (!$gift->getErrors()) {
                $this->redirect('/gift');
            }
        }

        $this->set(compact('gift', 'persons', 'events', 'personCategories'));
        $this->render('add');
    }

    public function delete(IGiftDeleteUseCase $giftDeleteUseCase, string $id = null) {
        if ($this->request->is('post') && $id) {
            $uid = $this->Auth->user('uid');
            $giftDeleteUseCase->delete($uid, $id);
        }

        return $this->redirect('/gift');
    }
}
