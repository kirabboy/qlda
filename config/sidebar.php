<?php
return [
    [
        'title' => 'dashboard',
        'route' => 'dashboard',
        'icon' => 'fa-solid fa-house',
        'roles' => [
            App\Enums\AdminRole::employee,
            App\Enums\AdminRole::supper_admin,
            App\Enums\AdminRole::admin_project,
        ],
        'sub' => []
    ],
    [
        'title' => 'project',
        'route' => null,
        'icon' => 'fa-solid fa-file',
        'roles' => [
            App\Enums\AdminRole::supper_admin,
            App\Enums\AdminRole::admin_project,

        ],
        'sub' => [
            [
                'title' => 'add',
                'route' => 'project.add',
                'icon' => 'fa-light fa-plus',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'route' => 'project.index',
                'icon' => 'fa-sharp fa-solid fa-list',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'project report',
        'route' => null,
        'icon' => 'fa-solid fa-flag',
        'roles' => [
            App\Enums\AdminRole::employee,
            App\Enums\AdminRole::supper_admin,

        ],
        'sub' => [
            [
                'title' => 'add',
                'route' => 'project.report.add',
                'icon' =>   'fa-light fa-plus',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'route' => 'project.report.index',
                'icon' => 'fa-sharp fa-solid fa-list',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'file download',
        'route' => 'dashboard',
        'icon' => 'fa-sharp fa-solid fa-file-arrow-down',
        'roles' => [
            App\Enums\AdminRole::employee,
            App\Enums\AdminRole::supper_admin,
        ]
    ],
    [
        'title' => 'library',
        'route' => 'dashboard',
        'icon' => 'fa-solid fa-bookmark',
        'roles' => [
            App\Enums\AdminRole::admin_project,
            App\Enums\AdminRole::supper_admin,
        ]
    ],
    [
        'title' => 'employee',
        'route' => 'dashboard',
        'icon' => 'fa-solid fa-users',
        'roles' => [
            App\Enums\AdminRole::admin_project,
            App\Enums\AdminRole::supper_admin,
        ]
    ],
    [
        'title' => 'account',
        'route' => 'dashboard',
        'icon' => 'fa-regular fa-user',
        'roles' => [
            App\Enums\AdminRole::supper_admin,
        ]
    ],
];
