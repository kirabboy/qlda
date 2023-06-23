<?php declare(strict_types=1);

use App\Enums\Projectsample;
use App\Enums\Projectstatus;

return [

    Projectstatus::class => [
        Projectstatus::approved => 'approved',
        Projectstatus::rejected => 'rejected',
        Projectstatus::submitted => 'submitted',
    ],  
    Projectsample::class => [
        Projectsample::approved => 'approved',
        Projectsample::rejected => 'rejected',
        Projectsample::Submitted => 'submitted',
    ],
];
