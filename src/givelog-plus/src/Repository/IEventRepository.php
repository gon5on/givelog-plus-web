<?php
namespace App\Repository;

use App\Model\Entity\Event;

interface IEventRepository {
    public function list(string $uid);

    public function add(string $uid, Event $entity);

    public function edit(string $uid, string $documentId, Event $entity);

    public function delete(string $uid, string $documentId);

}