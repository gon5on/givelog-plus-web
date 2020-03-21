<?php
namespace App\UseCase;

interface IPersonCategoryDeleteUseCase {
    public function delete(string $uid, string $id): string;
}