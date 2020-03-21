<?php
namespace App\UseCase;

use App\Model\Entity\User;

interface IUserPwReminderUseCase {
    public function reminder(array $data): User;
}