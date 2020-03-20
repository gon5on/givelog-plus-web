<?php
namespace App\UseCase;

interface IPersonUseCase {
    public function list(string $uid);

    public function add(string $uid, array $data);

    public function edit(string $uid, string $documentId, array $data);

    public function delete(string $uid, string $documentId);

    public function view(string $uid, string $documentId);
}