<?php
namespace App\Controller;

use Kreait\Firebase\Factory;


/**
 * イベント追加コントローラ
 */
class EventAddController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod(['post']);

        try {
            $uid = $this->Auth->user('uid');
            $data = [
                'name' => $this->request->getData('name'),
                'label_color' => '#999999',
            ];

            $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
            $firestore = $factory->createFirestore();
            $database = $firestore->database();
            $database->collection('users')->document($uid)->collection('event')->add($data);

        } catch (FirebaseException $e) {
            //TODO
            debug($e->getMessage());
        }

        return $this->redirect('/event-list');
    }
}
