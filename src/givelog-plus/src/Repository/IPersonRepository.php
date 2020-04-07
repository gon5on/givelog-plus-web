<?php
namespace App\Repository;

use App\Model\Entity\Person;

interface IPersonRepository {
    public function list(string $uid): array;

    public function add(string $uid, Person $entity): string;

    public function edit(string $uid, string $id, Person $entity): string;

    public function delete(string $uid, string $id): string;

    public function get(string $uid, string $id): Person;

    public function exist(string $uid, string $id): bool;

    public function idNameArrayWithCategory(string $uid): array;
}