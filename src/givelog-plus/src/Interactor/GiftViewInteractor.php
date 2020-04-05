<?php
namespace App\Interactor;

use App\UseCase\IGiftViewUseCase;
use App\Repository\IGiftRepository;
use App\Model\Entity\Gift;

class GiftViewInteractor implements IGiftViewUseCase {
    private $giftRepository;

    function __construct(IGiftRepository $giftRepository) {
        $this->giftRepository = $giftRepository;
    }

    public function view(string $uid, string $id): Gift {
        return $this->giftRepository->get($uid, $id);
    }
}