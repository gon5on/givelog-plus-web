<?php
namespace App\UseCase;

interface IEventDeleteUseCase {
    public function delete(string $uid, string $id): string;
}