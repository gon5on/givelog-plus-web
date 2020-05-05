<?php
namespace App\Interactor;

use Cake\Utility\Hash;
use App\UseCase\IUserRegisterUseCase;
use App\Repository\IUserRepository;
use App\Repository\IPersonRepository;
use App\Repository\IEventRepository;
use App\Repository\IEventTemplateRepository;
use App\Repository\IPersonCategoryRepository;
use App\Repository\IPersonCategoryTemplateRepository;
use App\Domain\UserRegisterDomain;
use App\Model\Entity\User;
use App\Model\Entity\Person;

class UserRegisterInteractor implements IUserRegisterUseCase {
    private $userRepository;
    private $personRepository;
    private $eventRepository;
    private $eventTemplateRepository;
    private $personCategoryRepository;
    private $personCategoryTemplateRepository;

    function __construct(IUserRepository $userRepository, IPersonRepository $personRepository,
        IEventRepository $eventRepository, IEventTemplateRepository $eventTemplateRepository,
        IPersonCategoryRepository $personCategoryRepository, IPersonCategoryTemplateRepository $personCategoryTemplateRepository) {

        $this->userRepository = $userRepository;
        $this->personRepository = $personRepository;
        $this->eventRepository = $eventRepository;
        $this->eventTemplateRepository = $eventTemplateRepository;
        $this->personCategoryRepository = $personCategoryRepository;
        $this->personCategoryTemplateRepository = $personCategoryTemplateRepository;
    }

    public function register(array $data): User {
        $entity = new User();

        $errors = (new UserRegisterDomain())->validation($data);
        if ($errors) {
            return $entity->setErrors($errors);
        }

        //ユーザ登録
        $entity = new User([
            'name' => Hash::get($data, 'name'),
            'email' => Hash::get($data, 'email'),
            'password' => Hash::get($data, 'password'),
        ]);

        $uid = $this->userRepository->register($entity);
        $entity->uid = $uid;

        //ユーザを初期人物データとして登録
        $this->__saveInitalPerson($uid, Hash::get($data, 'name'));

        //イベント初期データ登録
        $this->__saveInitalEvent($uid);

        //人物カテゴリ初期データ登録
        $this->__saveInitalPersonCategory($uid);

        return $entity;
    }

    private function __saveInitalPerson(string $uid, string $name): void {
        $entity = new Person(['name' => $name]);

        $this->personRepository->add($uid, $entity);
    }

    private function __saveInitalEvent(string $uid): void {
        $array = $this->eventTemplateRepository->list();

        foreach ($array as $data) {
            $this->eventRepository->add($uid, $data);
        }
    }

    private function __saveInitalPersonCategory(string $uid): void {
        $array = $this->personCategoryTemplateRepository->list();

        foreach ($array as $data) {
            $this->personCategoryRepository->add($uid, $data);
        }
    }
}