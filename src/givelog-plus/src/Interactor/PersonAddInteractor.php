<?php
namespace App\Interactor;

use Cake\Utility\Hash;
use App\UseCase\IPersonAddUseCase;
use App\Repository\IPersonRepository;
use App\Repository\IPersonCategoryRepository;
use App\Domain\PersonDomain;
use App\Model\Entity\Person;

class PersonAddInteractor implements IPersonAddUseCase {
    private $personRepository;
    private $personCategoryRepository;

    function __construct(IPersonRepository $personRepository, IPersonCategoryRepository $personCategoryRepository) {
        $this->personRepository = $personRepository;
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function add(string $uid, array $data): Person {
        $personCategories = $this->getParsonCategoryIdNameArray($uid);

        $personDomain = new PersonDomain();
        $errors = $personDomain->validation($data, $personCategories);

        if ($errors) {
            $entity = new Person();
            return $entity->setErrors($errors);
        }

        $entity = new Person([
            'name' => Hash::get($data, 'name'),
            'personCategoryId' => Hash::get($data, 'person_category_id'),
            'memo' => Hash::get($data, 'memo'),
        ]);

        $this->personRepository->add($uid, $entity);

        return $entity;
    }

    public function getParsonCategoryIdNameArray(string $uid): array {
        return $this->personCategoryRepository->idNameArray($uid);
    }
}