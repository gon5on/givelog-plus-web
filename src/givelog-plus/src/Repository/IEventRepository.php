<?php
namespace App\Repository;

use App\Model\Entity\Event;

interface IEventRepository {
    public function list(string $uid): array;

    public function add(string $uid, Event $entity): string;

    public function edit(string $uid, string $id, Event $entity): string;

    public function delete(string $uid, string $id): string;

    public function exist(string $uid, string $id): bool;

    public function idNameArray(string $uid): array;
}