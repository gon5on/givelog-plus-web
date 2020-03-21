<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IPersonDeleteUseCase;
use App\Repository\IPersonRepository;

class PersonDeleteInteractor implements IPersonDeleteUseCase {
    private $personRepository;

    function __construct(IPersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }

    public function delete(string $uid, string $id): string {
        if (!$this->personRepository->exist($uid, $id)) {
            throw new RecordNotFoundException('TODO');
        }

        $this->personRepository->delete($uid, $id);

        return $id;
    }
}