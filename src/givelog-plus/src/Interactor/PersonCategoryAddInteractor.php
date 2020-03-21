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
        $personCategoryDomain = new PersonCategoryDomain();

        $errors = $personCategoryDomain->validation($data);
        if ($errors) {
            $entity = new PersonCategory();
            return $entity->setErrors($errors);
        }

        $entity = new PersonCategory([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'label_color'),
        ]);

        $this->personCategoryRepository->add($uid, $entity);

        return $entity;
    }
}