<?php
namespace App\Interactor;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Utility\Hash;
use App\UseCase\IUserEditUseCase;
use App\Repository\IUserRepository;
use App\Domain\UserEditDomain;
use App\Model\Entity\User;

class UserEditInteractor implements IUserEditUseCase {
    private $userRepository;

    function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function edit(string $uid, array $data): User {
        $entity = new User();

        $errors = (new UserEditDomain())->validation($uid, $data);
        if ($errors) {
            return $entity->setErrors($errors);
        }

        $entity = new User([
            'uid' => $uid,
            'name' => Hash::get($data, 'name'),
            'email' => Hash::get($data, 'email'),
            'password' => Hash::get($data, 'password'),
        ]);

        $this->userRepository->edit($uid, $entity);

        return $entity;
    }
}