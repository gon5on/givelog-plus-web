<?php
namespace App\Interactor;

use App\UseCase\IGiftImageReadUseCase;
use App\Repository\IGiftImageStorageRepository;

class GiftImageReadInteractor implements IGiftImageReadUseCase {
    private $giftImageStorageRepository;

    function __construct(IGiftImageStorageRepository $giftImageStorageRepository) {
        $this->giftImageStorageRepository = $giftImageStorageRepository;
    }

    public function read(string $uid, string $id, string $fileName): string {
        return $this->giftImageStorageRepository->read($uid, $id, $fileName);
    }

    public function exist(string $uid, string $id, string $fileName): bool {
        return $this->giftImageStorageRepository->exist($uid, $id, $fileName);
    }

    public function mimeType(string $uid, string $id, string $fileName): string {
        return $this->giftImageStorageRepository->mimeType($uid, $id, $fileName);
    }
}