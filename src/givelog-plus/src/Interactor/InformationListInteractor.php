<?php
namespace App\Interactor;

use App\UseCase\IInformationListUseCase;
use App\Repository\IInformationRepository;

class InformationListInteractor implements IInformationListUseCase {
    private $informationRepository;

    function __construct(IInformationRepository $informationRepository) {
        $this->informationRepository = $informationRepository;
    }

    public function list(): array {
        return $this->informationRepository->list();
    }
}