<?php
return [
    [
        'title' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'bi bi-house-fill',
        'roles' => [],
        'sub' => []
    ],
    [
        'title' => 'Dự án',
        'route' => null,
        'icon' => 'bi bi-kanban-fill',
        'roles' => [
            App\Enums\AdminRole::supper_admin,
            App\Enums\AdminRole::admin_project,

        ],
        'sub' => [
            [
                'title' => 'Thêm dự án',
                'route' => 'project.add',
                'icon' => 'bi bi-plus',
                'roles' => [],
            ],
            [
                'title' => 'DS dự án',
                'route' => 'project.index',
                'icon' => 'bi bi-list-ul',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'Báo cáo dự án',
        'route' => null,
        'icon' => 'bi bi-flag-fill',
        'roles' => [
            App\Enums\AdminRole::employee,
            App\Enums\AdminRole::supper_admin,

        ],
        'sub' => [
            [
                'title' => 'Thêm báo cáo dự án',
                'route' => 'project.report.add',
                'icon' =>   'bi bi-plus',
                'roles' => [],
            ],
            [
                'title' => 'DS báo cáo dự án',
                'route' => 'project.report.index',
                'icon' => 'bi bi-list-ul',
                'roles' => [],
            ],
        ]
    ],
];
?>
