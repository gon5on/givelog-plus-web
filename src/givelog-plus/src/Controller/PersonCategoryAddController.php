<?php
namespace App\Controller;

use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FieldValue;


/**
 * 人物カテゴリ追加コントローラ
 */
class PersonCategoryAddController extends AppController
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
                'created' => FieldValue::serverTimestamp(),
                'mocified' => FieldValue::serverTimestamp(),
            ];

            $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
            $firestore = $factory->createFirestore();
            $database = $firestore->database();
            $database->collection('users')->document($uid)->collection('person_categories')->add($data);

        } catch (FirebaseException $e) {
            //TODO
            debug($e->getMessage());
        }

        return $this->redirect('/person-category-list');
    }
}
