<?php
namespace App\UseCase;

use App\Model\Entity\User;

interface IUserEditUseCase {
    public function edit(string $uid, array $data): User;
}