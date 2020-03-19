<?php
namespace App\Repository;

interface IEventRepository {
    public function add(string $uid, string $name, string $labelColor);

    public function delete(string $uid, string $documentId);

    public function list(string $uid);

    public function get(string $uid, string $documentId);
}