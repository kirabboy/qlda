<?php declare(strict_types=1);

use App\Enums\Projectcontract;
use App\Enums\Projectmaterial;
use App\Enums\ProjectReportStatus;
use App\Enums\Projectsample;
use App\Enums\Projectstatus;

return [

    Projectstatus::class => [
        Projectstatus::approved => 'Hoàn thành',
        Projectstatus::rejected => 'Chưa hoàn thành',
        Projectstatus::submitted => 'Mới cập nhật',
    ],
    Projectsample::class => [
        Projectsample::approved => 'Hoàn thành',
        Projectsample::rejected => 'Chưa hoàn thành',
        Projectsample::Submitted => 'Mới cập nhật',
    ],
    Projectcontract::class => [
        Projectcontract::not_yet => 'Chưa ký',
        Projectcontract::signed => 'Đã ký',
    ],
    Projectmaterial::class => [
        Projectmaterial::not_yet => 'Chưa hoàn thành',
        Projectmaterial::done => 'Đã xong',
    ],
    ProjectReportStatus::class => [
        ProjectReportStatus::approved => 'Hoàn thành',
        ProjectReportStatus::rejected => 'Chưa hoàn thành',
        ProjectReportStatus::submitted => 'Mới cập nhật'
    ]
];
