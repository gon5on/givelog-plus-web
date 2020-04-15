<?php
namespace App\UseCase;

interface IGiftImageReadUseCase {
    public function read(string $uid, string $id, string $fileName): string;

    public function exist(string $uid, string $id, string $fileName): bool;

    public function mimeType(string $uid, string $id, string $fileName): string;
}