<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\UseCase\IEventEditUseCase;
use App\Repository\IEventRepository;
use App\Domain\EventDomain;
use App\Model\Entity\Event;

class EventEditInteractor implements IEventEditUseCase {
    private $eventRepository;

    function __construct(IEventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function edit(string $uid, string $id, array $data): Event {
        $entity = new Event();

        $errors = (new EventDomain())->validation($data);
        if ($errors) {
            return $entity->setErrors($errors);
        }

        $entity = new Event([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'labelColor'),
        ]);

        $entity->id = $this->eventRepository->edit($uid, $id, $entity);

        return $entity;
    }
}