<?php
namespace App\UseCase;

use App\Model\Entity\User;

interface IUserRegisterUseCase {
    public function register(array $data): User;
}