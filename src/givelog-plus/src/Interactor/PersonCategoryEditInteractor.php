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
        if (!$this->personCategoryRepository->exist($uid, $id)) {
            throw new RecordNotFoundException('TODO');
        }

        $personCategoryDomain = new PersonCategoryDomain();

        $errors = $personCategoryDomain->validation($data);
        if ($errors) {
            $entity = new PersonCategory();
            return $entity->setErrors($errors);
        }

        $entity = new PersonCategory([
            'name' => Hash::get($data, 'name'),
            'labelColor' => Hash::get($data, 'labelColor'),
        ]);

        $this->personCategoryRepository->edit($uid, $id, $entity);

        return $entity;
    }
}