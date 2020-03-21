<?php
namespace App\Interactor;

use App\UseCase\IPersonCategoryListUseCase;
use App\Repository\IPersonCategoryRepository;

class PersonCategoryListInteractor implements IPersonCategoryListUseCase {
    private $personCategoryRepository;

    function __construct(IPersonCategoryRepository $personCategoryRepository) {
        $this->personCategoryRepository = $personCategoryRepository;
    }

    public function list(string $uid): array {
        return $this->personCategoryRepository->list($uid);
    }
}