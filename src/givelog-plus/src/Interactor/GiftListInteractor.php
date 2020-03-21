<?php
namespace App\Interactor;

use App\UseCase\IGiftListUseCase;
use App\Repository\IGiftRepository;

class GiftListInteractor implements IGiftListUseCase {
    private $giftRepository;

    function __construct(IGiftRepository $giftRepository) {
        $this->giftRepository = $giftRepository;
    }

    public function list(string $uid): array {
        return $this->giftRepository->list($uid);
    }
}