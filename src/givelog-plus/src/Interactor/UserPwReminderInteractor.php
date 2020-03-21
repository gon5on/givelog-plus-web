<?php
namespace App\Interactor;

use Cake\Utility\Hash;
use Cake\Routing\Router;
use App\UseCase\IUserPwReminderUseCase;
use App\Repository\IUserRepository;
use App\Domain\UserPwReminderDomain;
use App\Model\Entity\User;

class UserPwReminderInteractor implements IUserPwReminderUseCase {
    private $userRepository;

    function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function reminder(array $data): User {
        $userPwReminderDomain = new UserPwReminderDomain();

        $errors = $userPwReminderDomain->validation($data);
        if ($errors) {
            $entity = new User();
            return $entity->setErrors($errors);
        }

        $entity = new User([
            'email' => Hash::get($data, 'email'),
        ]);

        $this->userRepository->reminder($entity->email, Router::url('/reset-password', true));

        return $entity;
    }
}