<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\UseCase\IPersonCategoryEditUseCase;
use App\Repository\IPersonCategoryRepository;
use App\Domain\PersonCategoryDomain;
use App\Model\Entity\PersonCategory;

class PersonCategoryEditInteractor implements IPersonCategoryEditUseCase {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function edit(string $uid, string $id, array $data): PersonCategory {
        $entity = new PersonCategory();

        $errors = (new PersonCategoryDomain())->validation($data);
        if ($errors) {
            return $entity->setErrors($errors);
        }

        $entity = new PersonCategory([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'labelColor'),
        ]);

        $entity->id = $this->personCategoryRepository->edit($uid, $id, $entity);

        return $entity;
    }
}