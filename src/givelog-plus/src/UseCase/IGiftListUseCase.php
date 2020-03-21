<?php
namespace App\UseCase;

interface IGiftListUseCase {
    public function list(string $uid): array;
}