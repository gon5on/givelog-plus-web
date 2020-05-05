<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IPersonViewUseCase;
use App\Repository\IPersonRepository;
use App\Model\Entity\Person;

class PersonViewInteractor implements IPersonViewUseCase {
    private $personRepository;

    function __construct(IPersonRepository $personRepository) {
        $this->personRepository = $personRepository;
    }

    public function view(string $uid, string $id): Person {
        return $this->personRepository->get($uid, $id);
    }
}