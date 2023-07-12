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
        'title' => 'library',
        'route' => 'library.index',
        'icon' => 'fa-solid fa-bookmark',
        'roles' => [
            App\Enums\AdminRole::admin_project,
            App\Enums\AdminRole::supper_admin,
        ],
    ],
    [
        'title' => 'file download',
        'route' => 'file_download.index',
        'icon' => 'fa-sharp fa-solid fa-file-arrow-down',
        'roles' => [
            App\Enums\AdminRole::employee,
            App\Enums\AdminRole::supper_admin,
        ]
    ],
    [
        'title' => 'employee',
        'route' => null,
        'icon' => 'fa-solid fa-users',
        'roles' => [
            App\Enums\AdminRole::admin_project,
            App\Enums\AdminRole::supper_admin,
        ],
        'sub' => [
            [
                'title' => 'add',
                'route' => 'employee.add',
                'icon' =>   'fa-light fa-plus',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'route' => 'employee.index',
                'icon' => 'fa-sharp fa-solid fa-list',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'account',
        'route' => null,
        'icon' => 'fa-regular fa-user',
        'roles' => [
            App\Enums\AdminRole::supper_admin,
        ],
        'sub' => [
            [
                'title' => 'add',
                'route' => 'account.add',
                'icon' =>   'fa-light fa-plus',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'route' => 'account.index',
                'icon' => 'fa-sharp fa-solid fa-list',
                'roles' => [],
            ],
        ]
    ],
];
