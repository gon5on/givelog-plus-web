<?php
namespace App\Controller\Component;

use Cake\Event\Event;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class DIContainerComponent extends Component {

    public function beforeFilter(Event $event) {
        $controller = $this->_registry->getController();

        if ($controller instanceof \App\Controller\PersonCategoryController) {
            $controller->di(new \App\Interactor\PersonCategoryInteractor(new \App\Repository\PersonCategoryRepository()));
        }
        elseif ($controller instanceof \App\Controller\EventController) {
            $controller->di(new \App\Interactor\EventInteractor(new \App\Repository\EventRepository()));
        }
    }
}