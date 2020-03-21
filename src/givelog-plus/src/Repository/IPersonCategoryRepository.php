<?php
namespace App\Repository;

use App\Model\Entity\PersonCategory;

interface IPersonCategoryRepository {
    public function list(string $uid);

    public function add(string $uid, PersonCategory $entity);

    public function edit(string $uid, string $id, PersonCategory $entity);

    public function delete(string $uid, string $id);

    public function exist(string $uid, string $id);
}