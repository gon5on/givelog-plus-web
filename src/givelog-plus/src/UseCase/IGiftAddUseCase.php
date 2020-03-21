<?php
namespace App\UseCase;

use App\Model\Entity\Gift;

interface IGiftAddUseCase {
    public function add(string $uid, array $data): Gift;

    public function idNameArrayWithCategory(string $uid): array;

    public function getEventIdNameArray(string $uid): array;
}