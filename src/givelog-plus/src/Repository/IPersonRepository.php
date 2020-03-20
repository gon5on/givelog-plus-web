<?php
namespace App\Repository;

use App\Model\Entity\Person;

interface IPersonRepository {
    public function list(string $uid);

    public function add(string $uid, Person $entity);

    public function edit(string $uid, string $documentId, Person $entity);

    public function delete(string $uid, string $documentId);

    public function get(string $uid, string $documentId);
}