<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\UseCase\IPersonEditUseCase;
use App\Repository\IPersonRepository;
use App\Repository\IPersonCategoryRepository;
use App\Domain\PersonDomain;
use App\Model\Entity\Person;

class PersonEditInteractor implements IPersonEditUseCase {
    private $personRepository;
    private $personCategoryRepository;

    function __construct(IPersonRepository $personRepository, IPersonCategoryRepository $personCategoryRepository) {
        $this->personRepository = $personRepository;
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function edit(string $uid, string $id, array $data): Person {
        if (!$this->personRepository->exist($uid, $id)) {
            throw new RecordNotFoundException('TODO');
        }

        $personCategories = $this->getParsonCategoryIdNameArray($uid);

        $personDomain = new PersonDomain();
        $errors = $personDomain->validation($data, $personCategories);

        if ($errors) {
            $entity = new Person();
            return $entity->setErrors($errors);
        }

        $entity = new Person([
            'name' => Hash::get($data, 'name'),
            'personCategoryId' => Hash::get($data, 'personCategoryId'),
            'memo' => Hash::get($data, 'memo'),
        ]);

        $this->personRepository->edit($uid, $id, $entity);

        return $entity;
    }

    public function getParsonCategoryIdNameArray(string $uid): array {
        return $this->personCategoryRepository->idNameArray($uid);
    }
}