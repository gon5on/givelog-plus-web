<?php
namespace App\UseCase;

use App\Model\Entity\PersonCategory;

interface IPersonCategoryEditUseCase {
    public function edit(string $uid, string $id, array $data): PersonCategory;
}