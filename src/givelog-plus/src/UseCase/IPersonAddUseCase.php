<?php
namespace App\UseCase;

use App\Model\Entity\Person;

interface IPersonAddUseCase {
    public function add(string $uid, array $data): Person;

    public function getParsonCategoryIdNameArray(string $uid): array;
}