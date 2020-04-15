<?php
namespace App\Interactor;

use DateTime;
use Google\Cloud\Core\Timestamp;
use Cake\Utility\Hash;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\I18n\Time;
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

    const IMAGE_TMP_PATH = TMP . 'image' . DS ;
    const IMAGE_MAX_LONG_SIDE_SIZE = 1000;
    const IMAGE_TMP_EXPIRE = 60 * 60 * 24 * 3;
    
    function __construct(IGiftRepository $giftRepository, IPersonRepository $personRepository, IEventRepository $eventRepository) {
        $this->giftRepository = $giftRepository;
        $this->personRepository = $personRepository;
        $this->eventRepository = $eventRepository;
    }

    public function add(string $uid, array $data): Gift {
        $entity = new Gift();

        $GiftDomain = new GiftDomain();
        $errors = $GiftDomain->validation($data);

        if ($errors) {
            return $entity->setErrors($errors);
        }

        $entity = new Gift([
            'type' => Hash::get($data, 'type'),
            'date' => new Timestamp(new DateTime(Hash::get($data, 'date'))),
            'fromPersonIds' => Hash::get($data, 'from_person_ids'),
            'toPersonIds' => Hash::get($data, 'to_person_ids'),
            'gift' => Hash::get($data, 'gift'),
            'eventId' => Hash::get($data, 'event_id'),
            'price' => Hash::get($data, 'price'),
            'url' => Hash::get($data, 'url'),
            'imagePath' => $this->__getSrcImagePath($uid, Hash::get($data, 'image')),
            'memo' => Hash::get($data, 'memo'),
        ]);

        $entity->id = $this->giftRepository->add($uid, $entity);

        return $entity;
    }

    public function getPersonIdNameArrayWithCategory(string $uid): array {
        return $this->personRepository->idNameArrayWithCategory($uid);
    }

    public function getEventIdNameArray(string $uid): array {
        return $this->eventRepository->idNameArray($uid);
    }



    //TODO 画像処理をインタラクタが持つべきかわからない…
    private function __getSrcImagePath(string $uid, array $data): ?string {
        if (!$data) {
            return null;
        }

        $this->__deleteOldTmpFile();

        $tmpPath = Hash::get($data, 'tmp_name');
        if (!is_uploaded_file($tmpPath)) {
            throw new \Exception('TODO');
        }

        do {
            $distFileName = substr(bin2hex(random_bytes(24)), 0, 24);
            $distFileName .= '.' . pathinfo(Hash::get($data, 'name'), PATHINFO_EXTENSION);

            $distPath = self::IMAGE_TMP_PATH . $distFileName;

            if (!file_exists($distPath)) {
                break;
            }
        } while(true);

        if (!move_uploaded_file($tmpPath, $distPath)) {
            throw new \Exception('TODO');
        }

        $distPath = $this->__resizeImage($distPath);

        return $distPath;
    }

    private function __resizeImage($path): string {
        list($orgWidth, $orgHeight) = getimagesize($path);

        if ($orgWidth <= self::IMAGE_MAX_LONG_SIDE_SIZE && $orgHeight <= self::IMAGE_MAX_LONG_SIDE_SIZE) {
            return $orgPath;
        }

        if ($orgWidth <= $orgHeight) {
            $ratio = self::IMAGE_MAX_LONG_SIDE_SIZE / $orgHeight;
            $distHeight = self::IMAGE_MAX_LONG_SIDE_SIZE;
            $distWidth = round($orgWidth * $ratio);
        } else {
            $ratio = self::IMAGE_MAX_LONG_SIDE_SIZE / $orgWidth;
            $distWidth = self::IMAGE_MAX_LONG_SIDE_SIZE;
            $distHeight = round($orgHeight * $ratio);
        }

        switch (pathinfo($path, PATHINFO_EXTENSION)) {
            case 'jpg':
            case 'jpeg':
            case 'JPG':
            case 'JPEG':
                $imageCreateFromMethod = 'imagecreatefromjpeg';
                $imageExportMethod = 'imagejpeg';
                $quality = 90;
                break;
            case 'png':
            case 'PNG':
                $imageCreateFromMethod = 'imagecreatefrompng';
                $imageExportMethod = 'imagepng';
                $quality = 9;
                break;
            case 'gif':
            case 'GIF':
                $imageCreateFromMethod = 'imagecreatefromgif';
                $imageExportMethod = 'imagegif';
                $quality = 90;
                break;
        }

        $orgImg = $imageCreateFromMethod($path);
        $distImg = imagecreatetruecolor($distWidth, $distHeight);
 
        imagecopyresized($distImg, $orgImg, 0, 0, 0, 0, $distWidth, $distHeight, $orgWidth, $orgHeight);

        $imageExportMethod($distImg, $path, $quality);

        imagedestroy($orgImg);
        imagedestroy($distImg);

        return $path;
    }

    private function __deleteOldTmpFile() {
        $dir = new Folder(self::IMAGE_TMP_PATH);
        $fileNames = $dir->find();
        
        foreach ($fileNames as $fileName) {
            $filePath = $dir->path . $fileName;

            if (!is_file($filePath)) {
                continue;
            }

            $file = new File(self::IMAGE_TMP_PATH . $fileName);
            $lastChangeTime = Time::createFromTimestamp($file->lastChange());

            if (!$lastChangeTime->wasWithinLast(self::IMAGE_TMP_EXPIRE . ' seconds')) {
                $file->delete();
            }
        }
        
        exit;
    }
}