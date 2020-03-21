<?php
namespace App\Repository;

use App\Model\Entity\Person;

interface IPersonRepository {
    public function list(string $uid);

    public function add(string $uid, Person $entity);

    public function edit(string $uid, string $id, Person $entity);

    public function delete(string $uid, string $id);

    public function get(string $uid, string $id);
}