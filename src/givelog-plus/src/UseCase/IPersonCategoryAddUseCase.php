<?php
namespace App\UseCase;

use App\Model\Entity\PersonCategory;

interface IPersonCategoryAddUseCase {
    public function add(string $uid, array $data): PersonCategory;
}