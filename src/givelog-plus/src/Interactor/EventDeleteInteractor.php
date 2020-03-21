<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IEventDeleteUseCase;
use App\Repository\IEventRepository;

class EventDeleteInteractor implements IEventDeleteUseCase {
    private $eventRepository;

    function __construct(IEventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function delete(string $uid, string $id): string {
        if (!$this->eventRepository->exist($uid, $id)) {
            throw new RecordNotFoundException('TODO');
        }

        $this->eventRepository->delete($uid, $id);

        return $id;
    }
}