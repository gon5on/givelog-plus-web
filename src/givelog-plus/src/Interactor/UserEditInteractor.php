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
        if (!$this->userRepository->exist($uid)) {
            throw new RecordNotFoundException('TODO');
        }

        $userEditDomain = new UserEditDomain();

        $errors = $userEditDomain->validation($uid, $data);
        if ($errors) {
            $entity = new User();
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