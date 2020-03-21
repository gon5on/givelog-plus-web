<?php
namespace App\Interactor;

use App\UseCase\IPersonListUseCase;
use App\Repository\IPersonRepository;

class PersonListInteractor implements IPersonListUseCase {
    private $personRepository;

    function __construct(IPersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }

    public function list(string $uid): array {
        return $this->personRepository->list($uid);
    }
}