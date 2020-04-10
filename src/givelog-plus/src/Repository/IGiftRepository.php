<?php
namespace App\Repository;

use App\Model\Entity\Gift;

interface IGiftRepository {
    public function list(string $uid, array $search = null): array;

    public function add(string $uid, Gift $entity): string;

    public function edit(string $uid, string $id, Gift $entity): string;

    public function delete(string $uid, string $id): string;

    public function get(string $uid, string $id): Gift;

    public function exist(string $uid, string $id): bool;
}