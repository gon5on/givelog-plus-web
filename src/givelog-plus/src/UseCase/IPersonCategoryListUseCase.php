<?php
namespace App\UseCase;

interface IPersonCategoryListUseCase {
    public function list(string $uid): array;
}