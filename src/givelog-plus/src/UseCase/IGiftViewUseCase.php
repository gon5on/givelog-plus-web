<?php
namespace App\UseCase;

use App\Model\Entity\Gift;

interface IGiftViewUseCase {
    public function view(string $uid, string $id): Gift;
}