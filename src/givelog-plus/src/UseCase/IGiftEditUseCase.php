<?php
namespace App\UseCase;

use App\Model\Entity\Gift;

interface IGiftEditUseCase {
    public function edit(string $uid, string $id, array $data): Gift;
    
    public function get(string $uid, string $id): Gift;

    public function getPersonIdNameArrayWithCategory(string $uid): array;

    public function getEventIdNameArray(string $uid): array;
}