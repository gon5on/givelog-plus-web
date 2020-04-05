<?php
namespace App\Interactor;

use DateTime;
use Cake\Utility\Hash;
use Google\Cloud\Core\Timestamp;
use App\UseCase\IGiftAddUseCase;
use App\Repository\IGiftRepository;
use App\Repository\IPersonRepository;
use App\Repository\IEventRepository;
use App\Domain\GiftDomain;
use App\Model\Entity\Gift;

class GiftAddInteractor implements IGiftAddUseCase {
    private $giftRepository;
    private $personRepository;
    private $eventRepository;

    function __construct(IGiftRepository $giftRepository, IPersonRepository $personRepository, IEventRepository $eventRepository) {
        $this->giftRepository = $giftRepository;
        $this->personRepository = $personRepository;
        $this->eventRepository = $eventRepository;
    }

    public function add(string $uid, array $data): Gift {
        $GiftDomain = new GiftDomain();
        $errors = $GiftDomain->validation($data);

        if ($errors) {
            $entity = new Gift();
            return $entity->setErrors($errors);
        }

        $entity = new Gift([
            'type' => Hash::get($data, 'type'),
            'date' => new Timestamp(new DateTime(Hash::get($data, 'date'))),
            'fromPersonIds' => Hash::get($data, 'from_person_ids'),
            'toPersonIds' => Hash::get($data, 'to_person_ids'),
            'gift' => Hash::get($data, 'gift'),
            'event' => $this->eventRepository->getRef($uid, Hash::get($data, 'event_id')),
            'price' => Hash::get($data, 'price'),
            'url' => Hash::get($data, 'url'),
            'memo' => Hash::get($data, 'memo'),
        ]);

        foreach ($entity->fromPersonIds as $personId) {
            $fromPersons[] = $this->personRepository->getRef($uid, $personId);
        }
        foreach ($entity->toPersonIds as $personId) {
            $toPersons[] = $this->personRepository->getRef($uid, $personId);
        }
        $entity->fromPersons = $fromPersons;
        $entity->toPersons = $toPersons;

        $this->giftRepository->add($uid, $entity);

        return $entity;
    }

    public function getPersonIdNameArrayWithCategory(string $uid): array {
        return $this->personRepository->idNameArrayWithCategory($uid);
    }

    public function getEventIdNameArray(string $uid): array {
        return $this->eventRepository->idNameArray($uid);
    }
}