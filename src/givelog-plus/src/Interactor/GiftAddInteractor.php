<?php
namespace App\Interactor;

use DateTime;
use Google\Cloud\Core\Timestamp;
use Cake\Utility\Hash;
use App\UseCase\IGiftAddUseCase;
use App\Repository\IGiftRepository;
use App\Repository\IPersonRepository;
use App\Repository\IEventRepository;
use App\Domain\GiftDomain;
use App\Model\Entity\Gift;
use App\Utils\ImageUtils;

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
        $entity = new Gift();

        $events = $this->getEventIdNameArray($uid);
        $persons = $this->getPersonIdNameArrayWithCategory($uid);
        $errors = (new GiftDomain())->validation($data, $events, $persons);
        if ($errors) {
            return $entity->setErrors($errors);
        }

        $entity = $this->__createEntity($data);

        $entity->id = $this->giftRepository->add($uid, $entity);

        ImageUtils::deleteOldTmpFile(GiftDomain::IMAGE_TMP_PATH, GiftDomain::IMAGE_TMP_EXPIRE_SEC);

        return $entity;
    }

    public function getPersonIdNameArrayWithCategory(string $uid): array {
        return $this->personRepository->idNameArrayWithCategory($uid);
    }

    public function getEventIdNameArray(string $uid): array {
        return $this->eventRepository->idNameArray($uid);
    }

    private function __createEntity(array $data) {
        $entity = new Gift([
            'type' => Hash::get($data, 'type'),
            'date' => new Timestamp(new DateTime(Hash::get($data, 'date'))),
            'fromPersonIds' => Hash::get($data, 'fromPersonIds'),
            'toPersonIds' => Hash::get($data, 'toPersonIds'),
            'gift' => Hash::get($data, 'gift'),
            'eventId' => Hash::get($data, 'eventId'),
            'price' => Hash::get($data, 'price'),
            'url' => Hash::get($data, 'url'),
            'imagePath' => ImageUtils::uploadTmpFile(Hash::get($data, 'image'), GiftDomain::IMAGE_TMP_PATH, GiftDomain::IMAGE_TMP_EXPIRE_SEC),
            'memo' => Hash::get($data, 'memo'),
        ]);

        return $entity;
    }
}