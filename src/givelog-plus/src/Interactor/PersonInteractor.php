<?php
namespace App\Interactor;

use App\Model\Entity\Person;
use App\UseCase\IPersonUseCase;
use App\Repository\IPersonRepository;
use App\Domain\PersonDomain;

class PersonInteractor implements IPersonUseCase {
    private $personRepository;

    function __construct(IPersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }

    public function list(string $uid): array {
        return $this->personRepository->list($uid);
    }

    public function add(string $uid, array $data): Person {
        $personDomain = new PersonDomain();

        $entity = $personDomain->createEntity($data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->personRepository->add($uid, $entity);

        return $entity;
    }

    public function edit(string $uid, string $documentId, array $data): Person {
        $personDomain = new PersonDomain();

        $entity = $personDomain->createEntity($data);
        if ($entity->getErrors()) {
            return $entity;
        }

        $this->personRepository->edit($uid, $documentId, $entity);

        return $entity;
    }

    public function delete(string $uid, string $documentId) {
        $this->personRepository->delete($uid, $documentId);
    }

    public function view(string $uid, string $documentId) {
        //TODO
    }
}