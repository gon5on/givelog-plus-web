<?php
namespace App\Repository;

use App\Model\Entity\User;

interface IUserRepository {
    public function edit(string $uid, User $entity): string;

    public function exist(string $uid): bool;

    public function get(string $uid): User;

    public function verify(string $token): ?string;

    public function register(User $entity): string;

    public function reminder(string $email, string $url): void;
}