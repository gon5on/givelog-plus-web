<?php
namespace App\Interactor;

use App\Model\Entity\PersonCategory;
use App\UseCase\IPersonCategoryUseCase;
use App\Repository\IPersonCategoryRepository;
use App\Domain\PersonCategoryDomain;

class PersonCategoryInteractor implements IPersonCategoryUseCase {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function list(string $uid): array {
        return $this->personCategoryRepository->list($uid);
    }

    public function add(string $uid, array $data): PersonCategory {
        $personCategoryDomain = new PersonCategoryDomain();

        $entity = $personCategoryDomain->createEntity($data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->personCategoryRepository->add($uid, $entity);

        return $entity;
    }

    public function edit(string $uid, string $id, array $data): PersonCategory {
        $personCategoryDomain = new PersonCategoryDomain();

        $entity = $personCategoryDomain->createEntity($data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->personCategoryRepository->edit($uid, $id, $entity);

        return $entity;
    }

    public function delete(string $uid, string $id) {
        $this->personCategoryRepository->delete($uid, $id);
    }
}