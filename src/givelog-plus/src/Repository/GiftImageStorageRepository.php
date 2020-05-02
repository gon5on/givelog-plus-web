<?php
namespace App\Repository;

use Google\Cloud\Storage\StorageObject;
use Cake\Utility\Hash;

class GiftImageStorageRepository extends AppRepository implements IGiftImageStorageRepository {

    public function read(string $uid, string $documentId, string $fileName): string {
        $path = $this->__getPath($uid, $documentId, $fileName);
        $stream = $this->__getObject($path)->downloadAsStream();
        
        return $stream->getContents();
    }

    public function upload(string $uid, string $documentId, string $fileName, string $srcPath): string {
        $fp = fopen($srcPath, 'r');

        $distPath = $this->__getPath($uid, $documentId, $fileName);

        $this->storage->getBucket()->upload($fp, ['name' => $distPath]);

        return $distPath;
    }

    public function delete(string $path): string {
        $this->__getObject($path)->delete();

        return $path;
    }

    public function exist(string $uid, string $documentId, string $fileName): bool {
        $path = $this->__getPath($uid, $documentId, $fileName);

        return $this->__getObject($path)->exists();
    }

    public function mimeType(string $uid, string $documentId, string $fileName): string {
        $path = $this->__getPath($uid, $documentId, $fileName);
        $info = $this->__getObject($path)->info();

        return Hash::get($info, 'contentType');
    }

    private function __getObject(string $path): StorageObject {
        return $this->storage->getBucket()->object($path);
    }

    private function __getPath(string $uid, string $documentId, string $fileName): string {
        return "gifts/{$uid}/{$documentId}/{$fileName}";
    }
}