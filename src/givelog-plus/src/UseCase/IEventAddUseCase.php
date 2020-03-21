<?php
namespace App\UseCase;

use App\Model\Entity\Event;

interface IEventAddUseCase {
    public function add(string $uid, array $data): Event;
}