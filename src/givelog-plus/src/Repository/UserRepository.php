<?php
namespace App\Repository;

use Cake\Log\Log;
use App\Model\Entity\User;
use App\Utils\AppUtils;

class UserRepository extends AppRepository implements IUserRepository {
    const PROVIDER_PASSWORD = 'password';

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
        $user = $this->get($uid);

        if ($user->provider != self::PROVIDER_PASSWORD) {
            throw new \Exception('user can edit only registerd by email/password');
        }

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
            Log::write('error', AppUtils::beautifulExceptionLog($e));
            return false;
        }
    }

    public function get(string $uid): User {
        $user = $this->auth->getUser($uid);

        return new User([
            'uid' => $uid,
            'name' => $user->displayName,
            'email' => $user->email,
            'provider' => $user->providerData[0]->providerId,
        ]);
    }

    public function verify(string $idToken): ?string {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken, false);

            return $verifiedIdToken->getClaim('sub');

        } catch (\Exception $e) {
            Log::write('error', AppUtils::beautifulExceptionLog($e));
            return null;
        }
    }

    public function reminder(string $email): void {
        $this->auth->sendPasswordResetEmail($email);
    }

    public function disable(string $uid): void {
        $this->auth->disableUser($uid);
    }
}