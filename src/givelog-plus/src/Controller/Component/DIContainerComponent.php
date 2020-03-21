<?php
namespace App\Controller\Component;

use Cake\Event\Event;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class DIContainerComponent extends Component {

    public function beforeFilter(Event $event) {
        $controller = $this->_registry->getController();

        if ($controller instanceof \App\Controller\PersonCategoryController) {
            $personCategoryRepository = new \App\Repository\PersonCategoryRepository();
            $personCategoryInteractor = new \App\Interactor\PersonCategoryInteractor($personCategoryRepository);

            $controller->di($personCategoryInteractor);
        }
        elseif ($controller instanceof \App\Controller\EventController) {
            $eventRepository = new \App\Repository\EventRepository();
            $eventInteractor = new \App\Interactor\EventInteractor($eventRepository);

            $controller->di($eventInteractor);
        }
        elseif ($controller instanceof \App\Controller\PersonController) {
            $personRepository = new \App\Repository\PersonRepository();
            $personCategoryRepository = new \App\Repository\PersonCategoryRepository();
            $personInteractor = new \App\Interactor\PersonInteractor($personRepository, $personCategoryRepository);

            $controller->di($personInteractor);
        }
    }
}