<?php
namespace App\Interactor;

use App\UseCase\IEventListUseCase;
use App\Repository\IEventRepository;

class EventListInteractor implements IEventListUseCase {
    private $eventRepository;

    function __construct(IEventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function list(string $uid) {
        $this->eventRepository->list($uid);
    }
}