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
            /**
             * Use Case
             */
            'giftListUseCase' => function($c) {
                return new App\Interactor\GiftListInteractor(
                    $c['giftRepository'],
                );
            },
            'giftAddUseCase' => function($c) {
                return new App\Interactor\GiftAddInteractor(
                    $c['giftRepository'],
                    $c['personRepository'],
                    $c['eventRepository'],
                );
            },
            'giftEditUseCase' => function($c) {
                return new App\Interactor\GiftEditInteractor(
                    $c['giftRepository'],
                    $c['personRepository'],
                    $c['eventRepository'],
                );
            },
            'giftDeleteUseCase' => function($c) {
                return new App\Interactor\GiftDeleteInteractor(
                    $c['giftRepository'],
                );
            },

            'eventListUseCase' => function($c) {
                return new App\Interactor\EventListInteractor(
                    $c['eventRepository'],
                );
            },
            'eventAddUseCase' => function($c) {
                return new App\Interactor\EventAddInteractor(
                    $c['eventRepository'],
                );
            },
            'eventEditUseCase' => function($c) {
                return new App\Interactor\EventEditInteractor(
                    $c['eventRepository'],
                );
            },
            'eventDeleteUseCase' => function($c) {
                return new App\Interactor\EventDeleteInteractor(
                    $c['eventRepository'],
                );
            },

            'personListUseCase' => function($c) {
                return new App\Interactor\PersonListInteractor(
                    $c['personRepository'],
                );
            },
            'personAddUseCase' => function($c) {
                return new App\Interactor\PersonAddInteractor(
                    $c['personRepository'],
                    $c['personCategoryRepository'],
                );
            },
            'personEditUseCase' => function($c) {
                return new App\Interactor\PersonEditInteractor(
                    $c['personRepository'],
                    $c['personCategoryRepository'],
                );
            },
            'personDeleteUseCase' => function($c) {
                return new App\Interactor\PersonDeleteInteractor(
                    $c['personRepository'],
                );
            },
            'personViewUseCase' => function($c) {
                return new App\Interactor\PersonViewInteractor(
                    $c['personRepository'],
                );
            },

            'personCategoryListUseCase' => function($c) {
                return new App\Interactor\PersonCategoryListInteractor(
                    $c['personCategoryRepository'],
                );
            },
            'personCategoryAddUseCase' => function($c) {
                return new App\Interactor\PersonCategoryAddInteractor(
                    $c['personCategoryRepository'],
                );
            },
            'personCategoryEditUseCase' => function($c) {
                return new App\Interactor\PersonCategoryEditInteractor(
                    $c['personCategoryRepository'],
                );
            },
            'personCategoryDeleteUseCase' => function($c) {
                return new App\Interactor\PersonCategoryDeleteInteractor(
                    $c['personCategoryRepository'],
                );
            },

            'userRegisterUseCase' => function($c) {
                return new App\Interactor\UserRegisterInteractor(
                    $c['userRepository'],
                    $c['personRepository'],
                    $c['eventRepository'],
                    $c['eventTemplateRepository'],
                    $c['personCategoryRepository'],
                    $c['personCategoryTemplateRepository'],
                );
            },
            'userEditUseCase' => function($c) {
                return new App\Interactor\UserEditInteractor(
                    $c['userRepository'],
                );
            },

            'userPwReminderUseCase' => function($c) {
                return new App\Interactor\UserPwReminderInteractor(
                    $c['userRepository'],
                );
            },

            /**
             * Repository
             */
            'giftRepository' => function($c) {
                return new App\Repository\GiftRepository(
                    $c['personRepository'],
                    $c['eventRepository'],
                );
            },
            'personRepository' => function($c) {
                return new App\Repository\PersonRepository(
                    $c['personCategoryRepository'],
                );
            },
            'personCategoryRepository' => function($c) {
                return new App\Repository\PersonCategoryRepository();
            },
            'eventRepository' => function($c) {
                return new App\Repository\EventRepository();
            },
            'eventTemplateRepository' => function($c) {
                return new App\Repository\EventTemplateRepository();
            },
            'personCategoryTemplateRepository' => function($c) {
                return new App\Repository\PersonCategoryTemplateRepository();
            },
            'userRepository' => function($c) {
                return new App\Repository\UserRepository();
            },
        ]
    ]
];
