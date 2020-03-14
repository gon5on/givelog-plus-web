<?php
namespace App\Repository;

interface IEventRepository {
    public function save(string $uid/*, Event $event*/);

    public function delete(string $documentId);

    public function list(string $uid);

    public function get(string $documentId);
}