<?php
namespace App\Controller;

use Cake\ORM\Entity;
use Cake\Controller\Controller;
use App\Utils\AppUtils;

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

    protected function _catchExceptionForPost(\Exception $e, string $url) {
        $this->log(AppUtils::beautifulExceptionLog($e), 'error');

        switch (get_class($e)) {
            case 'Cake\Datasource\Exception\RecordNotFoundException':
                $this->Flash->error('このデータは削除されているか、存在しません');
                break;
            default:
                $this->Flash->error('エラーが発生しました、もう一度やり直してください');
        }

        return $this->redirect($url);
    }

    protected function _catchExceptionForAjax(\Exception $e) {
        $this->log(AppUtils::beautifulExceptionLog($e), 'error');

        switch (get_class($e)) {
            case 'Cake\Datasource\Exception\RecordNotFoundException':
                return $this->_getNotFoundAjaxResponse("このデータは削除されているか、存在しません");
                break;
            default:
                return $this->_getFatalErrorAjaxResponse('エラーが発生しました、もう一度やり直してください');
        }
    }

    protected function _getSuccessAjaxResponse(string $message, Entity $entity = null, string $html = null) {
        $data = [
            'message' => $message,
            'data' => ($entity) ? $entity->toArray() : null,
            'html' => $html,
        ];

        return $this->__getAjaxResponse(200, $data);
    }

    protected function _getErrorAjaxResponse(array $data) {
        return $this->__getAjaxResponse(400, $data);
    }

    protected function _getNotFoundAjaxResponse(string $message) {
        return $this->__getAjaxResponse(404, ['message' => $message]);
    }

    protected function _getFatalErrorAjaxResponse(string $message) {
        return $this->__getAjaxResponse(500, ['message' => $message]);
    }

    private function __getAjaxResponse($status, $data) {
        return $this->getResponse()->withStatus($status)->withType('json')->withStringBody(json_encode($data));
    }
}
