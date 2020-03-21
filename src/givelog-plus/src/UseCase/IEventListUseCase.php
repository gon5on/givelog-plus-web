<?php
namespace App\UseCase;

interface IEventListUseCase {
    public function list(string $uid): array;
}