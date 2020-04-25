<?php
namespace App\Repository;

use App\Model\Entity\User;

class UserRepository extends AppRepository implements IUserRepository {

    public function register(User $entity): string {
        $userProperties = [
            'email' => $entity->email,
            'emailVerified' => true,
            'password' => $entity->password,
            'displayName' => $entity->name,
            'disabled' => false,
        ];

        $user = $this->auth->createUser($userProperties);

        return $user->uid;
    }

    public function edit(string $uid, User $entity): string {
        $this->auth->changeUserEmail($uid, $entity->email);

        if ($entity->password) {
            $this->auth->changeUserPassword($uid, $entity->password);
        }

        return $uid;
    }

    public function exist(string $uid): bool {
        try {
            $this->auth->getUser($uid);
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function get(string $uid): User {
        $user = $this->auth->getUser($uid);

        return new User([
            'uid' => $uid,
            'name' => $user->displayName,
            'email' => $user->email,
        ]);
    }

    public function verify(string $idToken): string {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken, false);

            return $verifiedIdToken->getClaim('sub');

        } catch (\Exception $e) {
            return '';
        }
    }

    public function reminder(string $email, string $url): void {
        $this->auth->sendPasswordResetEmail($email, $url);
    }

    public function disable(string $uid): void {
        $this->auth->disableUser($uid);
    }
}