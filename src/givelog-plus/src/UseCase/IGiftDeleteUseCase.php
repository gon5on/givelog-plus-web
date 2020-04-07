<?php
namespace App\UseCase;

interface IGiftDeleteUseCase {
    public function delete(string $uid, string $id): string;
}