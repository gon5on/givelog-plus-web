<?php
namespace App\UseCase;

interface IPersonDeleteUseCase {
    public function delete(string $uid, string $id): string;
}