<?php
namespace App\UseCase;

interface IPersonListUseCase {
    public function list(string $uid): array;
}