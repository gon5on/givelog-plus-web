<?php
namespace App\UseCase;

use App\Model\Entity\Event;

interface IEventEditUseCase {
    public function edit(string $uid, string $id, array $data): Event;
}