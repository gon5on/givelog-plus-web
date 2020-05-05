<?php
namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IGiftListUseCase;
use App\UseCase\IGiftViewUseCase;
use App\UseCase\IGiftAddUseCase;
use App\UseCase\IGiftEditUseCase;
use App\UseCase\IGiftDeleteUseCase;
use App\UseCase\IPersonAddUseCase;
use App\UseCase\IEventAddUseCase;
use App\Model\Entity\Gift;
use App\Utils\AppUtils;

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

        try {
            $this->set('pageTitle', 'プレゼント詳細');

            $uid = $this->Auth->user('uid');
            $gift = $giftViewUseCase->view($uid, $id);

            $this->set(compact('gift'));

        } catch (RecordNotFoundException $e) {
            return $this->_catchExceptionForPost($e, '/gift');
        }
    }

    public function add(IGiftAddUseCase $giftAddUseCase, IPersonAddUseCase $personAddUseCase) {
        $this->set('pageTitle', 'プレゼント追加');

        try {
            $uid = $this->Auth->user('uid');
            $persons = $giftAddUseCase->getPersonIdNameArrayWithCategory($uid);
            $events = $giftAddUseCase->getEventIdNameArray($uid);
            $personCategories = $personAddUseCase->getParsonCategoryIdNameArray($uid);
    
            if ($this->request->is('post')) {
                $data = $this->request->getData();
                $gift = $giftAddUseCase->add($uid, $data);
                
                if (!$gift->getErrors()) {
                    return $this->redirect('/gift');
                }
            }

            $this->set(compact('persons', 'events', 'personCategories'));

        } catch (\Exception $e) {
            return $this->_catchExceptionForPost($e, '/gift/add');
        }
    }

    public function edit(IGiftEditUseCase $giftEditUseCase, IPersonAddUseCase $personAddUseCase, string $id = null) {
        if (!$id) {
            return $this->redirect('/gift');
        }

        try {
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
                    return $this->redirect('/gift');
                }
            }

            $this->set(compact('gift', 'persons', 'events', 'personCategories'));
            $this->render('add');

        } catch (\Exception $e) {
            return $this->_catchExceptionForPost($e, '/gift');
        }
    }

    public function delete(IGiftDeleteUseCase $giftDeleteUseCase, string $id = null) {
        if (!$this->request->is('ajax')) {
            return $this->redirect('/gift');
        }

        try {
            if (!$id) {
                throw new RecordNotFoundException('"id" is empty');
            }

            $uid = $this->Auth->user('uid');
            $giftDeleteUseCase->delete($uid, $id);

            return $this->_getSuccessAjaxResponse('削除しました');

        } catch (\Exception $e) {
            return $this->_catchExceptionForAjax($e);
        }
    }
}
