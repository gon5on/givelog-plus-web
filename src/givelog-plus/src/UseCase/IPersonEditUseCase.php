<?php
namespace App\UseCase;

use App\Model\Entity\Person;

interface IPersonEditUseCase {
    public function edit(string $uid, string $id, array $data): Person;
}