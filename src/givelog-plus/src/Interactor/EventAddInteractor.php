<?php
namespace App\Interactor;

use Cake\Utility\Hash;
use App\UseCase\IEventAddUseCase;
use App\Repository\IEventRepository;
use App\Domain\EventDomain;
use App\Model\Entity\Event;

class EventAddInteractor implements IEventAddUseCase {
    private $eventRepository;

    function __construct(IEventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function add(string $uid, array $data): Event {
        $eventDomain = new EventDomain();

        $errors = $eventDomain->validation($data);
        if ($errors) {
            $entity = new Event();
            return $entity->setErrors($errors);
        }
        
        $entity = new Event([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'label_color'),
        ]);

        $this->eventRepository->add($uid, $entity);

        return $entity;
    }
}