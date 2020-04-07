<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use App\UseCase\IGiftDeleteUseCase;
use App\Repository\IGiftRepository;

class GiftDeleteInteractor implements IGiftDeleteUseCase {
    private $giftRepository;

    function __construct(IGiftRepository $giftRepository) {
        $this->giftRepository = $giftRepository;
    }

    public function delete(string $uid, string $id): string {
        if (!$this->giftRepository->exist($uid, $id)) {
            throw new RecordNotFoundException('TODO');
        }

        $this->giftRepository->delete($uid, $id);

        return $id;
    }
}