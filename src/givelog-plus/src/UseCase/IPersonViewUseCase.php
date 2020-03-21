<?php
namespace App\UseCase;

use App\Model\Entity\Person;

interface IPersonViewUseCase {
    public function view(string $uid, string $id): Person;
}