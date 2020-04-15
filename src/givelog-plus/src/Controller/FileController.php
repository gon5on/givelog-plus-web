<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IGiftImageReadUseCase;

class FileController extends AppController {
    use InvokeActionTrait;

    public function giftImage(IGiftImageReadUseCase $giftImageReadUseCase, string $id, string $fileName) {
        $this->autoRender = false;

        $uid = $this->Auth->user('uid');

        if (!$giftImageReadUseCase->exist($uid, $id, $fileName)) {
            return;
        }

        $this->response->type($giftImageReadUseCase->mimeType($uid, $id, $fileName));
        $this->response->body($giftImageReadUseCase->read($uid, $id, $fileName));
    }
}
