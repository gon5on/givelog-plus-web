<?php

return [
    'CakePimpleDi' => [
        'actionInjections' => [
            '\App\Controller\GiftController' => [
                'index' => ['giftListUseCase'],
                'add' => ['giftAddUseCase', 'personAddUseCase', 'eventAddUseCase'],
                'edit' => ['giftEditUseCase', 'personAddUseCase', 'eventAddUseCase'],
                'delete' => ['giftDeleteUseCase'],
            ],
            '\App\Controller\EventController' => [
                'index' => ['eventListUseCase'],
                'add' => ['eventAddUseCase'],
                'edit' => ['eventEditUseCase'],
                'delete' => ['eventDeleteUseCase'],
            ],
            '\App\Controller\PersonController' => [
                'index' => ['personListUseCase', 'personAddUseCase'],
                'add' => ['personAddUseCase'],
                'edit' => ['personEditUseCase'],
                'delete' => ['personDeleteUseCase'],
                'view' => ['personViewUseCase', 'personEditUseCase'],
            ],
            '\App\Controller\PersonCategoryController' => [
                'index' => ['personCategoryListUseCase'],
                'add' => ['personCategoryAddUseCase'],
                'edit' => ['personCategoryEditUseCase'],
                'delete' => ['personCategoryDeleteUseCase'],
            ],
            '\App\Controller\RegisterController' => [
                'index' => ['userRegisterUseCase'],
            ],
            '\App\Controller\ForgetPasswordController' => [
                'index' => ['userPwReminderUseCase'],
            ],
            '\App\Controller\SettingController' => [
                'userEdit' => ['userEditUseCase'],
            ],
        ],
        'services' => [
            'giftListUseCase' => function() {
                return new App\Interactor\GiftListInteractor(
                    new App\Repository\GiftRepository()
                );
            },
            'giftAddUseCase' => function() {
                return new App\Interactor\GiftAddInteractor(
                    new App\Repository\GiftRepository(),
                    new App\Repository\PersonRepository(),
                    new App\Repository\EventRepository()
                );
            },
            'giftEditUseCase' => function() {
                return new App\Interactor\GiftEditInteractor(
                    new App\Repository\GiftRepository(),
                    new App\Repository\PersonRepository(),
                    new App\Repository\EventRepository()
                );
            },
            'giftDeleteUseCase' => function() {
                return new App\Interactor\GiftDeleteInteractor(
                    new App\Repository\GiftRepository()
                );
            },

            'eventListUseCase' => function() {
                return new App\Interactor\EventListInteractor(
                    new App\Repository\EventRepository()
                );
            },
            'eventAddUseCase' => function() {
                return new App\Interactor\EventAddInteractor(
                    new App\Repository\EventRepository()
                );
            },
            'eventEditUseCase' => function() {
                return new App\Interactor\EventEditInteractor(
                    new App\Repository\EventRepository()
                );
            },
            'eventDeleteUseCase' => function() {
                return new App\Interactor\EventDeleteInteractor(
                    new App\Repository\EventRepository()
                );
            },

            'personListUseCase' => function() {
                return new App\Interactor\PersonListInteractor(
                    new App\Repository\PersonRepository()
                );
            },
            'personAddUseCase' => function() {
                return new App\Interactor\PersonAddInteractor(
                    new App\Repository\PersonRepository(),
                    new App\Repository\PersonCategoryRepository()
                );
            },
            'personEditUseCase' => function() {
                return new App\Interactor\PersonEditInteractor(
                    new App\Repository\PersonRepository(),
                    new App\Repository\PersonCategoryRepository()
                );
            },
            'personDeleteUseCase' => function() {
                return new App\Interactor\PersonDeleteInteractor(
                    new App\Repository\PersonRepository()
                );
            },
            'personViewUseCase' => function() {
                return new App\Interactor\PersonViewInteractor(
                    new App\Repository\PersonRepository()
                );
            },

            'personCategoryListUseCase' => function() {
                return new App\Interactor\PersonCategoryListInteractor(
                    new App\Repository\PersonCategoryRepository()
                );
            },
            'personCategoryAddUseCase' => function() {
                return new App\Interactor\PersonCategoryAddInteractor(
                    new App\Repository\PersonCategoryRepository()
                );
            },
            'personCategoryEditUseCase' => function() {
                return new App\Interactor\PersonCategoryEditInteractor(
                    new App\Repository\PersonCategoryRepository()
                );
            },
            'personCategoryDeleteUseCase' => function() {
                return new App\Interactor\PersonCategoryDeleteInteractor(
                    new App\Repository\PersonCategoryRepository()
                );
            },

            'userRegisterUseCase' => function() {
                return new App\Interactor\UserRegisterInteractor(
                    new App\Repository\UserRepository(),
                    new App\Repository\PersonRepository(),
                    new App\Repository\EventRepository(),
                    new App\Repository\EventTemplateRepository(),
                    new App\Repository\PersonCategoryRepository(),
                    new App\Repository\PersonCategoryTemplateRepository(),
                );
            },
            'userEditUseCase' => function() {
                return new App\Interactor\UserEditInteractor(
                    new App\Repository\UserRepository()
                );
            },

            'userPwReminderUseCase' => function() {
                return new App\Interactor\UserPwReminderInteractor(
                    new App\Repository\UserRepository()
                );
            },
        ]
    ]
];
