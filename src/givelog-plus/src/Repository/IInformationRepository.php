<?php
namespace App\Repository;

use App\Model\Entity\Information;

interface IInformationRepository {
    public function list(): array;
}