<?php
namespace App\Repository;

use App\Repository\IPersonRepository;
use App\Repository\IGiftRepository;
use App\Model\Entity\Person;

/**
 * PersonRepositoryにGiftRepositoryをDIすると、循環参照になってしまうので、
 * 人物に紐づくプレゼントを取得するために新たなリポジトリを用意した
 */
class PersonWithGiftRepository extends AppRepository implements IPersonRepository {
    private $personRepository;
    private $giftRepository;

    function __construct(IPersonRepository $personRepository, IGiftRepository $giftRepository) {
        parent::__construct();

        $this->personRepository = $personRepository;
        $this->giftRepository = $giftRepository;
    }

    public function get(string $uid, string $documentId): Person {
        $entity = $this->personRepository->get($uid, $documentId);
        $entity->gifts = $this->giftRepository->list($uid, ['personIds' => [$documentId]]);

        return $entity;
    }


    //以下、implementsを満たすためだけに、PersonRepositoryのメソッドをただただ呼んでいる

    public function list(string $uid, array $search = null): array {
        return $this->personRepository->list($uid, $search);
    }

    public function add(string $uid, Person $entity): string {
        return $this->personRepository->add($uid, $entity);
    }

    public function edit(string $uid, string $id, Person $entity): string {
        return $this->personRepository->edit($uid, $id, $entity);
    }

    public function delete(string $uid, string $id): string {
        return $this->personRepository->delete($uid, $id);
    }

    public function exist(string $uid, string $id): bool {
        return $this->personRepository->exist($uid, $id);
    }

    public function idNameArrayWithCategory(string $uid): array {
        return $this->personRepository->idNameArrayWithCategory($uid);
    }
}