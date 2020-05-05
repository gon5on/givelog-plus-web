<?php
namespace App\Interactor;

use Cake\Utility\Hash;
use App\UseCase\IPersonCategoryAddUseCase;
use App\Repository\IPersonCategoryRepository;
use App\Domain\PersonCategoryDomain;
use App\Model\Entity\PersonCategory;

class PersonCategoryAddInteractor implements IPersonCategoryAddUseCase {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function add(string $uid, array $data): PersonCategory {
        $entity = new PersonCategory();

        $errors = (new PersonCategoryDomain())->validation($data);
        if ($errors) {
            return $entity->setErrors($errors);
        }

        $entity = new PersonCategory([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'labelColor'),
        ]);

        $entity->id = $this->personCategoryRepository->add($uid, $entity);

        return $entity;
    }
}