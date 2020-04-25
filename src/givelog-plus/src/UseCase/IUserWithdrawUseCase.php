<?php
namespace App\UseCase;

interface IUserWithdrawUseCase {
    public function withdraw(string $uid): void;
}