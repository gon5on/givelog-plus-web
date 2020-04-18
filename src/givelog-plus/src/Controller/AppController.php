<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller {

    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Login',
                'action' => 'index',
            ],
            'loginRedirect' => [
                'controller' => 'Gift',
                'action' => 'index',
            ],
            'logoutRedirect' => [
                'controller' => 'Login',
                'action' => 'index',
            ],
            'authenticate' => [
                'Firebase',
            ],
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    protected function getAjaxResponse($entity) {
        $status = 200;
        $data = [];

        if ($entity->getErrors()) {
            $status = 400;
            $data = $entity->getErrors();
        } else {
            $status = 200;
            $data = $entity->toArray();
        }

        return $this->getResponse()->withStatus($status)->withType('json')->withStringBody(json_encode($data));
    }
}
