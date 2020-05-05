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
        $entity = new Event();

        $errors = (new EventDomain())->validation($data);
        if ($errors) {
            return $entity->setErrors($errors);
        }
        
        $entity = new Event([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'labelColor'),
        ]);

        $entity->id = $this->eventRepository->add($uid, $entity);

        return $entity;
    }
}