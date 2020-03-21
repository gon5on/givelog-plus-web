<?php
namespace App\UseCase;

interface IPersonUseCase {
    public function list(string $uid);

    public function add(string $uid, array $data);

    public function edit(string $uid, string $id, array $data);

    public function delete(string $uid, string $id);

    public function view(string $uid, string $id);
}