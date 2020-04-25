<?php
namespace App\Interactor;

use App\UseCase\IUserWithdrawUseCase;
use App\Repository\IUserRepository;

class UserWithdrawInteractor implements IUserWithdrawUseCase {
    private $userRepository;

    function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function withdraw(string $uid): void {
        $this->userRepository->disable($uid);
    }
}