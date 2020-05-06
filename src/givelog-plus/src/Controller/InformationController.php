<?php
namespace App\Controller;

use RochaMarcelo\CakePimpleDi\Di\InvokeActionTrait;
use App\UseCase\IInformationListUseCase;

class InformationController extends AppController {
    use InvokeActionTrait;

    public function index(IInformationListUseCase $informationListUseCase) {
        $this->set('pageTitle', 'お知らせ');

        $informations = $informationListUseCase->list();

        $this->set(compact('informations'));
    }
}
