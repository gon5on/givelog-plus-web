<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IPersonCategoryDeleteUseCase;
use App\Repository\IPersonCategoryRepository;

class PersonCategoryDeleteInteractor implements IPersonCategoryDeleteUseCase {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function delete(string $uid, string $id): string {
        if (!$this->personCategoryRepository->exist($uid, $id)) {
            throw new RecordNotFoundException('TODO');
        }

        $this->personCategoryRepository->delete($uid, $id);

        return $id;
    }
}