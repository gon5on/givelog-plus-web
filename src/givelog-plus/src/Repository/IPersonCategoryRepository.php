<?php
namespace App\Repository;

use Google\Cloud\Firestore\DocumentReference;
use Google\Cloud\Firestore\DocumentSnapshot;
use App\Model\Entity\PersonCategory;

interface IPersonCategoryRepository {
    public function list(string $uid): array;

    public function add(string $uid, PersonCategory $entity): string;

    public function edit(string $uid, string $id, PersonCategory $entity): string;

    public function delete(string $uid, string $id): string;

    public function exist(string $uid, string $id): bool;

    public function idNameArray(string $uid): array;

    public function getRef(string $uid, ?string $documentId): ?DocumentReference;

    public function documentToEntity(DocumentSnapshot $document): PersonCategory;
}