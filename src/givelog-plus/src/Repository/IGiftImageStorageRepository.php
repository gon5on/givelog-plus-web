<?php
namespace App\Repository;

interface IGiftImageStorageRepository {
    public function read(string $uid, string $documentId, string $fileName): string;

    public function upload(string $uid, string $documentId, string $fileName, string $srcPath): string;

    public function delete(string $path): string;

    public function exist(string $uid, string $documentId, string $fileName): bool;

    public function mimeType(string $uid, string $documentId, string $fileName): string;
}