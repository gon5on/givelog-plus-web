<?php
namespace App\Controller;

use Kreait\Firebase\Factory;

/**
 * 人物カテゴリリストコントローラ
 */
class PersonCategoryListController extends AppController
{
    /**
     * インデックスアクション
     * 
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->set('page_title', '人物カテゴリリスト');

        $uid = $this->Auth->user('uid');

        $factory = (new Factory)->withServiceAccount(ROOT . DS . 'config/google-service-account.json');
        $firestore = $factory->createFirestore();
        $database = $firestore->database();

        $query = $database
                    ->collection('users')
                    ->document($uid)
                    ->collection('person_categories')
                    ->orderBy('created', 'DESC');
        $documents = $query->documents();

        foreach ($documents as $document) {
            if ($document->exists()) {
                //debug($document->data());
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
    }
}
