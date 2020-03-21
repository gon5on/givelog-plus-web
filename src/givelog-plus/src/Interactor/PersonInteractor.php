<?php
namespace App\Interactor;

use App\Model\Entity\Person;
use App\UseCase\IPersonUseCase;
use App\Repository\IPersonRepository;
use App\Repository\IPersonCategoryRepository;
use App\Domain\PersonDomain;

class PersonInteractor implements IPersonUseCase {
    private $personRepository;
    private $personCategoryRepository;

    function __construct(IPersonRepository $personRepository, IPersonCategoryRepository $personCategoryRepository) {
        $this->personRepository = $personRepository;
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function list(string $uid): array {
        return $this->personRepository->list($uid);
    }

    public function add(string $uid, array $data): Person {
        $personDomain = new PersonDomain($this->personCategoryRepository);

        $entity = $personDomain->createEntity($uid, $data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->personRepository->add($uid, $entity);

        return $entity;
    }

    public function edit(string $uid, string $id, array $data): Person {
        $personDomain = new PersonDomain($this->personCategoryRepository);

        $entity = $personDomain->createEntity($uid, $data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->personRepository->edit($uid, $id, $entity);

        return $entity;
    }

    public function delete(string $uid, string $id) {
        $this->personRepository->delete($uid, $id);
    }

    public function view(string $uid, string $id) {
        return $this->personRepository->get($uid, $id);
    }
}