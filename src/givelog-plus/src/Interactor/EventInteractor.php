<?php
namespace App\Interactor;

use App\Model\Entity\Event;
use App\UseCase\IEventUseCase;
use App\Repository\IEventRepository;
use App\Domain\EventDomain;

class EventInteractor implements IEventUseCase {
    private $eventRepository;

    function __construct(IEventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function list(string $uid): array {
        return $this->eventRepository->list($uid);
    }

    public function add(string $uid, array $data): Event {
        $eventDomain = new EventDomain();

        $entity = $eventDomain->createEntity($data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->eventRepository->add($uid, $entity);

        return $entity;
    }

    public function edit(string $uid, string $documentId, array $data): Event {
        $eventDomain = new EventDomain();

        $entity = $eventDomain->createEntity($data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->eventRepository->edit($uid, $documentId, $entity);

        return $entity;
    }

    public function delete(string $uid, string $documentId) {
        $this->eventRepository->delete($uid, $documentId);
    }
}