<?php
namespace App\Interactor;

use App\UseCase\IEventUseCase;
use App\Repository\IEventRepository;

class EventInteractor implements IEventUseCase {
    private $eventRepository;

    function __construct(IEventRepository $eventRepository) {
        $this->eventRepository = $eventRepository;
    }

    public function list(string $uid) {
        return $this->eventRepository->list($uid);
    }

    public function add(string $uid, string $name, string $labelColor) {
        //TODO バリデーション

        $this->eventRepository->add($uid, $name, $labelColor);
    }

    public function edit(string $uid, string $documentId, string $name, string $labelColor) {
        //TODO
    }

    public function delete(string $uid, string $documentId) {
        //TODO
    }
}